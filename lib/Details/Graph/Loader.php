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
use Kompakt\B3d\Details\Graph\PopulatorRunnerInterface;

class Loader
{
    protected $artistRepository = null;
    protected $artistPopulatorRunner = null;
    protected $labelRepository = null;
    protected $labelPopulatorRunner = null;
    protected $productRepository = null;
    protected $productPopulatorRunner = null;
    protected $productTrackRepository = null;
    protected $productTrackPopulatorRunner = null;
    protected $releaseRepository = null;
    protected $releasePopulatorRunner = null;
    protected $trackRepository = null;
    protected $trackPopulatorRunner = null;
    protected $missingArtists = 0;
    protected $missingLabels = 0;
    protected $missingTracks = 0;

    public function __construct(
        $artistRepository,
        PopulatorRunnerInterface $artistPopulatorRunner,
        $labelRepository,
        PopulatorRunnerInterface $labelPopulatorRunner,
        $productRepository,
        PopulatorRunnerInterface $productPopulatorRunner,
        $productTrackRepository,
        PopulatorRunnerInterface $productTrackPopulatorRunner,
        $releaseRepository,
        PopulatorRunnerInterface $releasePopulatorRunner,
        $trackRepository,
        PopulatorRunnerInterface $trackPopulatorRunner
    )
    {
        $this->artistRepository = $artistRepository;
        $this->artistPopulatorRunner = $artistPopulatorRunner;
        $this->labelRepository = $labelRepository;
        $this->labelPopulatorRunner = $labelPopulatorRunner;
        $this->productRepository = $productRepository;
        $this->productPopulatorRunner = $productPopulatorRunner;
        $this->productTrackRepository = $productTrackRepository;
        $this->productTrackPopulatorRunner = $productTrackPopulatorRunner;
        $this->releaseRepository = $releaseRepository;
        $this->releasePopulatorRunner = $releasePopulatorRunner;
        $this->trackRepository = $trackRepository;
        $this->trackPopulatorRunner = $trackPopulatorRunner;
    }

    public function load()
    {
        $this->artistPopulatorRunner->run();
        $this->labelPopulatorRunner->run();
        $this->productPopulatorRunner->run();
        $this->releasePopulatorRunner->run();
        $this->productTrackPopulatorRunner->run();
        $this->trackPopulatorRunner->run();

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

        $products = $this->productRepository->getAllByReleaseId($release->getId());

        foreach ($products as $product)
        {
            $this->handleProduct($release, $product);
        }
    }

    protected function handleProduct(Release $release, Product $product)
    {
        $release->addProduct($product);
        $product->setRelease($release);

        $productTracks = $this->productTrackRepository->getAllByProductId($product->getId());

        foreach ($productTracks as $productTrack)
        {
            $this->handleProductTrack($release, $product, $productTrack);
        }
    }

    protected function handleProductTrack(Release $release, Product $product, ProductTrack $productTrack)
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