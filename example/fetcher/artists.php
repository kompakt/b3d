<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

require sprintf('%s/bootstrap.php', dirname(__DIR__));

use Kompakt\B3d\Entity\Artist;
use Kompakt\B3d\Fetcher\ArtistFetcher;

$fetcher = new ArtistFetcher($client, new Artist());
$artists = $fetcher->fetchAll();
echo sprintf("%s\n", count($artists));
die(print_r($artists));