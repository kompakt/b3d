<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

require sprintf('%s/bootstrap.php', dirname(dirname(__DIR__)));

use Kompakt\B3d\Util\File\Reader;

// config
$stockFilePathname = sprintf('%s/php-cache-data/stocks.data', EXAMPLE_KOMPAKT_B3D_TEMP_DIR);

// general
$fileReader = new Reader();

// run
$data = $fileReader->read($stockFilePathname);
$items = unserialize($data);
$accountIds = [];

foreach ($items as $productId => $productStock)
{
    if (!$productStock)
    {
        continue;
    }

    foreach ($productStock as $accountId => $stocks)
    {
        if (!array_key_exists($accountId, $accountIds))
        {
            $accountIds[$accountId] = 0;
        }

        $accountIds[$accountId]++;
    }
}

print_r($accountIds);