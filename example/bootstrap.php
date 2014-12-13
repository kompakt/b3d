<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

use GuzzleHttp\Client;

// load testing configuration
require_once (file_exists(__DIR__ . '/config.php')) ? 'config.php' : 'config.php.dist';

// autoloader
require_once dirname(__DIR__) . '/vendor/autoload.php';

// some defaults
date_default_timezone_set('UTC');

$client = new Client(
    array(
        'base_url' => EXAMPLE_KOMPAKT_BASE_URL,
        'defaults' => array(
            'query' => array(
                'api_key' => EXAMPLE_KOMPAKT_API_KEY
            )
        )
    )
);