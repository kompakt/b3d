<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

require sprintf('%s/bootstrap.php', dirname(__DIR__));

use Kompakt\B3d\Details\Endpoint\Resource\Price\Endpoint as PriceEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Price\Mapper as PriceMapper;
use Kompakt\B3d\Details\Entity\Price;

$endpoint = new PriceEndpoint($client);
$mapper = new PriceMapper(new Price());

$count = 0;
$currencyIds = [];
$currencyIsos = [];
$externalTables = [];
$pricelistIds = [];
$pricelistNames = [];
$productIds = [];

foreach ($endpoint->fetchAll() as $item)
{
    $count++;
    $price = $mapper->map($item);
    $currencyIds[$price->getCurrencyId()] = null;
    $currencyIsos[$price->getCurrencyIso()] = null;
    $externalTables[$price->getExternalTable()] = null;
    $pricelistIds[$price->getPricelistId()] = $price->getPricelistName();
    $pricelistNames[$price->getPricelistName()] = $price->getPricelistId();
    $productIds[$price->getProductId()] = null;
}

echo sprintf("%s prices\n", $count);
echo sprintf("%s products\n", count($productIds));

print_r($currencyIds);
print_r($currencyIsos);
print_r($externalTables);
print_r($pricelistIds);
print_r($pricelistNames);