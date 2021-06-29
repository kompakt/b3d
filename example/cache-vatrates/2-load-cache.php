<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

require sprintf('%s/bootstrap.php', dirname(__DIR__));

use Kompakt\B3d\Details\Entity\VatRate;
use Kompakt\B3d\Details\Repository\VatRateRepository;
use Kompakt\B3d\Details\Endpoint\Resource\VatRate\Mapper;
use Kompakt\B3d\Details\Populator\Cache\PhpFile\Populator;
use Kompakt\B3d\Util\File\Reader;
use Symfony\Component\Stopwatch\Stopwatch;

// config
$vatrateFilePathname = sprintf('%s/php-cache-vatrate-data/vatrates.data', EXAMPLE_KOMPAKT_B3D_TEMP_DIR);

// general
$fileReader = new Reader();

// entities
$vatrate = new VatRate();

// data-mapper
$vatrateMapper = new Mapper($vatrate);

// repo
$vatrateRepository = new VatRateRepository();

// populator
$fileVatRatePopulator = new Populator(
    $vatrateMapper,
    $vatrateRepository,
    $fileReader,
    $vatrateFilePathname
);

// run
$stopwatch = new Stopwatch();
$stopwatch->start('b3d', 'b3d');
$fileVatRatePopulator->populate();
$event = $stopwatch->stop('b3d');

$uuids = [];
$territories = [];

foreach ($vatrateRepository->getAll() as $vatrate)
{
    if (!array_key_exists($vatrate->getUuid(), $uuids))
    {
        $uuids[$vatrate->getUuid()] = [];
    }
    else {
        $uuids[$vatrate->getUuid()][] = $vatrate;
    }

    if (!array_key_exists($vatrate->getVatTerritory(), $territories))
    {
        $territories[$vatrate->getVatTerritory()] = [];
    }
    else {
        $territories[$vatrate->getVatTerritory()][] = $vatrate;
    }
}

#print_r($uuids);
print_r($territories['SI']);

echo sprintf("%s\n", $event);
echo sprintf("VatRate: %s\n", count($vatrateRepository->getAll()));