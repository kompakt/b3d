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
        ArtistRepository $artistRepository,
        PopulatorInterface $artistPopulator,
        LabelRepository $labelRepository,
        PopulatorInterface $labelPopulator,
        PriceRepository $priceRepository,
        PopulatorInterface $pricePopulator,
        ProductRepository $productRepository,
        PopulatorInterface $productPopulator,
        ProductTrackRepository $productTrackRepository,
        PopulatorInterface $productTrackPopulator,
        ReleaseRepository $releaseRepository,
        PopulatorInterface $releasePopulator,
        TrackRepository $trackRepository,
        PopulatorInterface $trackPopulator
    )
    {
        $this->artistRepository = $artistRepository;
        $this->artistPopulator = $artistPopulator;
        $this->labelRepository = $labelRepository;
        $this->labelPopulator = $labelPopulator;
        $this->priceRepository = $priceRepository;
        $this->pricePopulator = $pricePopulator;
        $this->productRepository = $productRepository;
        $this->productPopulator = $productPopulator;
        $this->productTrackRepository = $productTrackRepository;
        $this->productTrackPopulator = $productTrackPopulator;
        $this->releaseRepository = $releaseRepository;
        $this->releasePopulator = $releasePopulator;
        $this->trackRepository = $trackRepository;
        $this->trackPopulator = $trackPopulator;
    }

    public function load()
    {
        $this->artistPopulator->populate();
        $this->labelPopulator->populate();
        $this->pricePopulator->populate();
        $this->productPopulator->populate();
        $this->releasePopulator->populate();
        $this->productTrackPopulator->populate();
        $this->trackPopulator->populate();

        foreach ($this->releaseRepository->getAll() as $release)
        {
            $this->handleRelease($release);
        }

        return $this->releaseRepository;
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

            if ($artist)
            {
                #echo sprintf("%s\n", $artist->getName());
            }
            else {
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