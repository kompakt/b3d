<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

require sprintf('%s/bootstrap.php', dirname(__DIR__));

use Kompakt\B3d\Details\Endpoint\Resource\Artist\Endpoint as ArtistEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Label\Endpoint as LabelEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Price\Endpoint as PriceEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Product\Endpoint as ProductEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\ProductTrack\Endpoint as ProductTrackEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Release\Endpoint as ReleaseEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Stock\Endpoint as StockEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Track\Endpoint as TrackEndpoint;

$endpoints = [
    new ArtistEndpoint($client),
    new LabelEndpoint($client),
    new PriceEndpoint($client),
    new ProductEndpoint($client),
    new ProductTrackEndpoint($client),
    new ReleaseEndpoint($client),
    new StockEndpoint($client),
    new TrackEndpoint($client)
];

$locations = [];

foreach ($endpoints as $endpoint)
{
    $items = $endpoint->fetchAll();
    
    echo sprintf("%s\n", get_class($endpoint));

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