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
use Kompakt\B3d\Details\Endpoint\Resource\VatRate\Mapper as VatRateMapper;
use Kompakt\B3d\Details\Populator\Cache\PhpFile\Populator;
use Kompakt\B3d\Util\File\Reader;
use Kompakt\B3d\Util\File\Writer;
use Symfony\Component\Stopwatch\Stopwatch;

// config
$vatrateFilePathname = sprintf('%s/php-cache-vatrate-data/vatrates.data', EXAMPLE_KOMPAKT_B3D_TEMP_DIR);

// general
$fileReader = new Reader();

// entities
$vatrate = new VatRate();

// data-mapper
$vatrateMapper = new VatRateMapper($vatrate);

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

foreach ($vatrateRepository->getAll() as $vatrate)
{
    echo sprintf("%s\n", $vatrate->getUuid());
    print_r($vatrate);
}

echo sprintf("%s\n", $event);
echo sprintf("VatRate: %s\n", count($vatrateRepository->getAll()));