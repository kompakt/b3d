<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\Price;

use Kompakt\B3d\Details\Endpoint\Resource\BaseMapper;
use Kompakt\B3d\Details\Entity\Price;
use Kompakt\B3d\Details\Populator\DataMapperInterface;

class Mapper extends BaseMapper implements DataMapperInterface
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
        $price->setCurrencyId($this->trim($data['currency_id']));
        $price->setCurrencyIso($this->trim($data['currency_iso']));
        $price->setExternalTable($this->trim($data['external_table']));
        $price->setPayback($this->trim($data['payback']));
        $price->setPrice($this->trim($data['price']));
        $price->setPricelistId($this->trim($data['price_list_id']));
        $price->setPricelistName($this->trim($data['price_list_name']));
        $price->setProductId($this->trim($data['product_id']));
        $price->setProductPriceId($this->trim($data['product_price_id']));
        return $price;
    }
}