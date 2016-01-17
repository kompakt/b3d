<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\Price;

use Kompakt\B3d\Details\Entity\Price;
use Kompakt\B3d\Details\Populator\DataMapperInterface;

class Mapper implements DataMapperInterface
{
    protected $pricePrototype = null;

    public function __construct(Price $pricePrototype)
    {
        $this->pricePrototype = $pricePrototype;
    }

    /**
     * @see DataMapperInterface::map()
     */
    public function map(array $data)
    {
        $price = clone $this->pricePrototype;
        $price->setCurrencyId(trim($data['currency_id']));
        $price->setCurrencyIso(trim($data['currency_iso']));
        $price->setExternalTable(trim($data['external_table']));
        $price->setPayback(trim($data['payback']));
        $price->setPrice(trim($data['price']));
        $price->setPricelistId(trim($data['price_list_id']));
        $price->setPricelistName(trim($data['price_list_name']));
        $price->setProductId(trim($data['product_id']));
        $price->setProductPriceId(trim($data['product_price_id']));
        return $price;
    }
}