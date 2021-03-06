<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

#use GuzzleHttp\Client;
use Kompakt\TestHelper\Filesystem\TmpDir;

// load testing configuration
require_once (file_exists(__DIR__ . '/config.php')) ? 'config.php' : 'config.php.dist';

// autoloader
require_once dirname(__DIR__) . '/vendor/autoload.php';

// some defaults
date_default_timezone_set('UTC');

function getTmpDir()
{
    return new TmpDir(EXAMPLE_KOMPAKT_B3D_TEMP_DIR);
}