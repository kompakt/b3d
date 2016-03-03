<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Graph;

use Kompakt\B3d\Details\Entity\Product;
use Kompakt\B3d\Details\Entity\ProductTrack;
use Kompakt\B3d\Details\Entity\Release;
use Kompakt\B3d\Details\Graph\PopulatorInterface;
use Kompakt\B3d\Details\Repository\ArtistRepository;
use Kompakt\B3d\Details\Repository\LabelRepository;
use Kompakt\B3d\Details\Repository\PriceRepository;
use Kompakt\B3d\Details\Repository\ProductRepository;
use Kompakt\B3d\Details\Repository\ProductTrackRepository;
use Kompakt\B3d\Details\Repository\ReleaseRepository;
use Kompakt\B3d\Details\Repository\TrackRepository;

class Loader
{
    protected $artistRepository = null;
    protected $artistPopulator = null;
    protected $labelRepository = null;
    protected $labelPopulator = null;
    protected $priceRepository = null;
    protected $pricePopulator = null;
    protected $productRepository = null;
    protected $productPopulator = null;
    protected $productTrackRepository = null;
    protected $productTrackPopulator = null;
    protected $releaseRepository = null;
    protected $releasePopulator = null;
    protected $trackRepository = null;
    protected $trackPopulator = null;
    protected $missingArtists = 0;
    protected $missingLabels = 0;
    protected $missingTracks = 0;

    public function __construct(
        PopulatorInterface $artistPopulator,
        PopulatorInterface $labelPopulator,
        PopulatorInterface $pricePopulator,
        PopulatorInterface $productPopulator,
        PopulatorInterface $productTrackPopulator,
        PopulatorInterface $releasePopulator,
        PopulatorInterface $trackPopulator
    )
    {
        $this->artistPopulator = $artistPopulator;
        $this->labelPopulator = $labelPopulator;
        $this->pricePopulator = $pricePopulator;
        $this->productPopulator = $productPopulator;
        $this->productTrackPopulator = $productTrackPopulator;
        $this->releasePopulator = $releasePopulator;
        $this->trackPopulator = $trackPopulator;
    }

    public function load()
    {
        $this->artistRepository = $this->artistPopulator->populate();
        $this->labelRepository = $this->labelPopulator->populate();
        $this->priceRepository = $this->pricePopulator->populate();
        $this->productRepository = $this->productPopulator->populate();
        $this->releaseRepository = $this->releasePopulator->populate();
        $this->productTrackRepository = $this->productTrackPopulator->populate();
        $this->trackRepository = $this->trackPopulator->populate();

        foreach ($this->releaseRepository->getAll() as $release)
        {
            $this->handleRelease($release);
        }

        return $this->releaseRepository;
    }

    public function getArtistRepository()
    {
        return $this->artistRepository;
    }

    public function getLabelRepository()
    {
        return $this->labelRepository;
    }

    public function getPriceRepository()
    {
        return $this->priceRepository;
    }

    public function getProductRepository()
    {
        return $this->productRepository;
    }

    public function getReleaseRepository()
    {
        return $this->releaseRepository;
    }

    public function getProductTrackRepository()
    {
        return $this->productTrackRepository;
    }

    public function getTrackRepository()
    {
        return $this->trackRepository;
    }

    public function getMissingArtists()
    {
        return $this->missingArtists;
    }

    public function getMissingLabels()
    {
        return $this->missingLabels;
    }

    public function getMissingTracks()
    {
        return $this->missingTracks;
    }

    protected function handleRelease(Release $release)
    {
        $label = $this->labelRepository->getById($release->getLabelId());

        if ($label)
        {
            $release->setLabel($label);

            $artist = $this->artistRepository->getByLabelArtistId($label->getId());

            if (!$artist)
            {
                $this->missingArtists++;
            }
        }
        else {
            $this->missingLabels++;
        }

        $products = $this->productRepository->getAllByReleaseId($release->getReleaseId());

        foreach ($products as $product)
        {
            $this->handleProduct($release, $product);
        }
    }

    protected function handleProduct(Release $release, Product $product)
    {
        $release->addProduct($product);
        $product->setRelease($release);

        $productTracks = $this->productTrackRepository->getAllByProductId($product->getProductId());

        foreach ($productTracks as $productTrack)
        {
            $this->handleProductTrack($product, $productTrack);
        }

        $prices = $this->priceRepository->getAllByProductId($product->getProductId());

        foreach ($prices as $price)
        {
            $product->addPrice($price);
            $price->setProduct($product);
        }
    }

    protected function handleProductTrack(Product $product, ProductTrack $productTrack)
    {
        $track = $this->trackRepository->getById($productTrack->getTrackId());

        if ($track)
        {
            $product->addProductTrack($productTrack);
            $productTrack->setProduct($product);
            $productTrack->setTrack($track);
            $track->addProductTrack($productTrack);
        }
        else {
            // throw inconsistency exception
            $this->missingTracks++;
        }
    }
}