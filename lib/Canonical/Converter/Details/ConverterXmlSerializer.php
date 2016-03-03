<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Canonical\Converter\Details;

use Kompakt\B3d\Canonical\Converter\Details\Product as ProductConverter;
use Kompakt\B3d\Canonical\Serializer\Xml\Product as ProductXmlSerializer;
use Kompakt\B3d\Details\Graph\Loader as DetailsGraphLoader;

class ConverterXmlSerializer
{
    protected $graphLoader = null;
    protected $converter = null;
    protected $serializer = null;

    public function __construct(
        DetailsGraphLoader $graphLoader,
        ProductConverter $converter,
        ProductXmlSerializer $serializer
    )
    {
        $this->graphLoader = $graphLoader;
        $this->converter = $converter;
        $this->serializer = $serializer;
    }

    public function run()
    {
        $detailsReleaseRepository = $this->graphLoader->load();

        foreach ($detailsReleaseRepository->getAll() as $release)
        {
            foreach ($release->getProducts() as $product)
            {
                $canonicalProduct = $this->converter->map($product);
                $this->serializer->serialize($canonicalProduct);
            }
        }
    }
}