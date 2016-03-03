<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Canonical\Converter\Details;

use Kompakt\B3d\Canonical\Converter\Details\Product as ProductConverter;
use Kompakt\B3d\Details\Graph\Loader as DetailsGraphLoader;
use Kompakt\CollectionRunner\Runner as CollectionRunner;

class ConverterRunner
{
    protected $collectionRunner = null;
    protected $graphLoader = null;
    protected $converter = null;
    protected $detailsReleaseRepository = null;

    public function __construct(
        CollectionRunner $collectionRunner,
        DetailsGraphLoader $graphLoader,
        ProductConverter $converter
    )
    {
        $this->collectionRunner = $collectionRunner;
        $this->graphLoader = $graphLoader;
        $this->converter = $converter;
    }

    public function getGraphLoader()
    {
        return $this->graphLoader;
    }

    public function load()
    {
        $this->detailsReleaseRepository = $this->graphLoader->load();
    }

    public function run($numReleasesPerPage = 100)
    {
        if (!$this->detailsReleaseRepository)
        {
            $this->load();
        }

        $getPaginatedDetailsReleasesCallback = function($first, $max)
        {
            $detailsReleases = $this->detailsReleaseRepository->getSlice($first, $max);
            $canonicalProducts = [];

            foreach ($detailsReleases as $detailsRelease)
            {
                foreach ($detailsRelease->getProducts() as $product)
                {
                    $canonicalProducts[] = $this->converter->map($product);
                }
            }

            return $canonicalProducts;
        };

        $this->collectionRunner->run(
            count($this->detailsReleaseRepository->getAll()),
            $getPaginatedDetailsReleasesCallback,
            $numReleasesPerPage
        );
    }
}