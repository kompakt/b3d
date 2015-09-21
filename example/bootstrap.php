<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

use GuzzleHttp\Client;
use Kompakt\TestHelper\Filesystem\TmpDir;

// load testing configuration
require_once (file_exists(__DIR__ . '/config.php')) ? 'config.php' : 'config.php.dist';

// autoloader
require_once dirname(__DIR__) . '/vendor/autoload.php';

// some defaults
date_default_timezone_set('UTC');

$client = new Client(
    array(
        'base_url' => EXAMPLE_KOMPAKT_B3D_BASE_URL,
        'defaults' => array(
            'query' => array(
                'api_key' => EXAMPLE_KOMPAKT_B3D_API_KEY
            )
        )
    )
);

function getTmpDir()
{
    return new TmpDir(EXAMPLE_KOMPAKT_B3D_TEMP_DIR);
}