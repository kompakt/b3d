<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Serializer\Xml\Release;

use Kompakt\B3d\Entity\Release;
use Kompakt\B3d\Serializer\Xml\Release\Exception\InvalidArgumentException;
use Kompakt\B3d\Serializer\Xml\Release\ReleaseXmlBuilder;

class ReleaseXmlWriter
{
    protected $xmlBuilder = null;
    protected $release = null;

    public function __construct(
        ReleaseXmlBuilder $xmlBuilder,
        Release $release
    )
    {
        $this->xmlBuilder = $xmlBuilder;
        $this->release = $release;
    }

    public function write($file)
    {
        $info = new \SplFileInfo(dirname($file));

        if (!$info->isDir())
        {
            throw new InvalidArgumentException(sprintf('Xml dir not found'));
        }

        if (!$info->isWritable())
        {
            throw new InvalidArgumentException(sprintf('Xml dir not writable'));
        }

        $dom = $this->xmlBuilder->build($this->release);
        $dom->formatOutput = true;
        $fileInfo = new \SplFileInfo($file);

        if ($fileInfo->isFile())
        {
            unlink($file);
        }

        $h = fopen($file, 'w');
        fwrite($h, $dom->saveXML());
        fclose($h);
    }
}