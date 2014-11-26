<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

require sprintf('%s/bootstrap.php', dirname(__DIR__));

use Kompakt\B3d\Entity\Track;
use Kompakt\B3d\Fetcher\TrackFetcher;

$fetcher = new TrackFetcher($client, new Track());
$tracks = $fetcher->fetchAll();
echo sprintf("%s\n", count($tracks));

foreach ($tracks as $track)
{
    if (preg_match('/ay ay ay/i', $track->getTitle()))
    {
        die(print_r($track));
    }
}