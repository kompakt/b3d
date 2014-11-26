<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

use Guzzle\Http\Client;

// load testing configuration
require_once (file_exists(__DIR__ . '/config.php')) ? 'config.php' : 'config.php.dist';

// autoloader
require_once dirname(__DIR__) . '/vendor/autoload.php';

$client = new Client(
    'http://api.berlin3.com/api/kompaktlabel/',
    array(
        'request.options' => array(
            'query' => array(
                'api_key' => EXAMPLE_KOMPAKT_API_KEY
            )
        )
    )
);