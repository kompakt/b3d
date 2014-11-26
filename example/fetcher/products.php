<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

require sprintf('%s/bootstrap.php', dirname(__DIR__));

use Kompakt\B3d\Entity\Product;
use Kompakt\B3d\Fetcher\ProductFetcher;

$fetcher = new ProductFetcher($client, new Product());
$products = $fetcher->fetchAll();
echo sprintf("%s\n", count($products));
die(print_r($products[0]));