<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Unserializer\Xml\Release\Factory;

use Kompakt\B3d\Unserializer\Xml\Release\ReleaseXmlParser;
use Kompakt\B3d\Unserializer\Xml\Release\ReleaseXmlReader;

class ReleaseXmlReaderFactory
{
    protected $xmlParser = null;

    public function __construct(ReleaseXmlParser $xmlParser)
    {
        $this->xmlParser = $xmlParser;
    }

    public function getInstance($file)
    {
        return new ReleaseXmlReader($this->xmlParser, $file);
    }
}