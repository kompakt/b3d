<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

require sprintf('%s/bootstrap.php', dirname(__DIR__));

use Kompakt\B3d\Entity\Release;
use Kompakt\B3d\Repository\ReleaseRepository;
use Kompakt\B3d\Unserializer\Xml\Release\Factory\ReleaseXmlReaderFactory;
use Kompakt\B3d\Unserializer\Xml\Release\ReleaseXmlLoader;
use Kompakt\B3d\Unserializer\Xml\Release\ReleaseXmlParser;

$xmlDirPathname = sprintf('%s/_files/releases', __DIR__);

// compose
$releasePrototype = new Release();
$releaseXmlParser = new ReleaseXmlParser($releasePrototype);
$releaseXmlReaderFactory = new ReleaseXmlReaderFactory($releaseXmlParser);
$repository = new ReleaseRepository();
$loader = new ReleaseXmlLoader($repository, $releaseXmlReaderFactory);

// run
$loader->load($xmlDirPathname);
print_r($repository->getAll());