<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Serializer\Xml\Release\Factory;

use Kompakt\B3d\Entity\Release;
use Kompakt\B3d\Serializer\Xml\Release\ReleaseXmlBuilder;
use Kompakt\B3d\Serializer\Xml\Release\ReleaseXmlWriter;

class ReleaseXmlWriterFactory
{
    protected $xmlBuilder = null;
    protected $release = null;

    public function __construct(ReleaseXmlBuilder $xmlBuilder)
    {
        $this->xmlBuilder = $xmlBuilder;
    }

    public function getInstance(Release $release)
    {
        return new ReleaseXmlWriter($this->xmlBuilder, $release);
    }
}