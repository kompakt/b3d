<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

require sprintf('%s/bootstrap.php', dirname(__DIR__));

use Kompakt\B3d\Details\Entity\Stock;
use Kompakt\B3d\Details\Entity\StockAccount;
use Kompakt\B3d\Details\Repository\StockRepository;
use Kompakt\B3d\Details\Endpoint\Resource\Stock\Mapper as StockMapper;
use Kompakt\B3d\Details\Populator\Cache\PhpFile\StockPopulator as FileStockPopulator;
use Kompakt\B3d\Details\Populator\Data\StockPopulator as DataStockPopulator;
use Kompakt\B3d\Util\File\Reader;
use Kompakt\B3d\Util\File\Writer;
use Kompakt\B3d\Util\Timer\Timer;

// config
$stockFilePathname = sprintf('%s/php-cache-stock-data/stocks.data', EXAMPLE_KOMPAKT_B3D_TEMP_DIR);

// general
$fileReader = new Reader();

// entities
$stock = new Stock();
$stockAccount = new StockAccount();

// data-mapper
$stockMapper = new StockMapper($stock, $stockAccount);

// repo
$stockRepository = new StockRepository();

// populator
$dataStockPopulator = new DataStockPopulator(
    $stockMapper,
    $stockRepository
);

$fileStockPopulator = new FileStockPopulator(
    $dataStockPopulator,
    $fileReader,
    $stockFilePathname
);

// run
$timer = new Timer();
$timer->start();
$fileStockPopulator->populate();
$timer->stop();

foreach ($stockRepository->getAll() as $stock)
{
    echo sprintf("%s\n", $stock->getProductUuid());
    print_r($stock->getAccounts());
}

echo sprintf("Stock: %s\n", count($stockRepository->getAll()));
echo sprintf("Memory: %s Mb\n", round(memory_get_usage() / 1024 / 1024, 0));
echo sprintf("Time: %s Sec\n", $timer->getSeconds(0));