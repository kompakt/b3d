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
$stockFilePathname = sprintf('%s/php-cache-data/products.data', EXAMPLE_KOMPAKT_B3D_TEMP_DIR);

// general
$fileReader = new Reader();

// run
$data = $fileReader->read($stockFilePathname);
$products = unserialize($data);
$uuids = [];

foreach ($products as $product)
{
    if (!array_key_exists($product['UUID'], $uuids))
    {
        $uuids[$product['UUID']] = 0;
    }

    $uuids[$product['UUID']]++;
}

print_r($uuids);