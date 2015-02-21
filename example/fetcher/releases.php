<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

require sprintf('%s/bootstrap.php', dirname(__DIR__));

use Kompakt\B3d\Entity\Release;
use Kompakt\B3d\Fetcher\ReleaseFetcher;

$tmpDir = getTmpDir();
$tmpDirPathname = $tmpDir->replaceSubDir('fetcher/releases');

$fetcher = new ReleaseFetcher($client, new Release());
$releases = $fetcher->fetchAll();
echo sprintf("%s\n", count($releases));

foreach ($releases as $release)
{
    die(print_r($release));
}