<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

require sprintf('%s/bootstrap.php', dirname(__DIR__));

use Kompakt\B3d\Entity\Label;
use Kompakt\B3d\Fetcher\LabelFetcher;

$fetcher = new LabelFetcher($client, new Label());
$labels = $fetcher->fetchAll();
echo sprintf("%s\n", count($labels));

foreach ($labels as $label)
{
    if (preg_match('/kompakt/i', $label->getName()))
    {
        die(print_r($label));
    }
}