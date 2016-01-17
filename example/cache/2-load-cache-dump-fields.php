<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

require sprintf('%s/bootstrap.php', dirname(__DIR__));

use Kompakt\B3d\Util\File\Reader;

// config
$tmpDir = getTmpDir();
$canonicalProductTmpDirPathname = $tmpDir->replaceSubDir('php-cache-xml');

$files = [
    sprintf('%s/php-cache-data/artists.data', EXAMPLE_KOMPAKT_B3D_TEMP_DIR),
    sprintf('%s/php-cache-data/labels.data', EXAMPLE_KOMPAKT_B3D_TEMP_DIR),
    sprintf('%s/php-cache-data/prices.data', EXAMPLE_KOMPAKT_B3D_TEMP_DIR),
    sprintf('%s/php-cache-data/products.data', EXAMPLE_KOMPAKT_B3D_TEMP_DIR),
    sprintf('%s/php-cache-data/product-tracks.data', EXAMPLE_KOMPAKT_B3D_TEMP_DIR),
    sprintf('%s/php-cache-data/releases.data', EXAMPLE_KOMPAKT_B3D_TEMP_DIR),
    sprintf('%s/php-cache-data/tracks.data', EXAMPLE_KOMPAKT_B3D_TEMP_DIR)
];

// general
$fileReader = new Reader();

foreach ($files as $file)
{
    $data = $fileReader->read($file);
    $items = unserialize($data);

    echo sprintf("%s\n", $file);

    foreach ($items as $item)
    {
        $fields = [];

        foreach ($item as $k => $v)
        {
            $fields[] = $k;
        }

        sort($fields, SORT_NATURAL);

        foreach ($fields as $field)
        {
            echo sprintf("+ %s\n", $field);
        }

        break;
    }
}