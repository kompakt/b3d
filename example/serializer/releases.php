<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

require sprintf('%s/bootstrap.php', dirname(__DIR__));

use Kompakt\B3d\Entity\Release;
use Kompakt\B3d\Fetcher\ReleaseFetcher;
use Kompakt\B3d\Serializer\Xml\Release\Factory\ReleaseXmlWriterFactory;
use Kompakt\B3d\Serializer\Xml\Release\ReleaseXmlBuilder;

$tmpDir = getTmpDir();
$tmpDirPathname = $tmpDir->replaceSubDir('serializer/releases');

// compose
$releasePrototype = new Release();
$releaseXmlWriterFactory = new ReleaseXmlWriterFactory(new ReleaseXmlBuilder());
$fetcher = new ReleaseFetcher($client, $releasePrototype);

// run
$releases = $fetcher->fetchAll();
echo sprintf("%s\n", count($releases));

foreach ($releases as $release)
{
    $writer = $releaseXmlWriterFactory->getInstance($release);
    $writer->write(sprintf('%s/%s.xml', $tmpDirPathname, uniqid()));
}