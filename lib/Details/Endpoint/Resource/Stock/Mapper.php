<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\Stock;

use Kompakt\B3d\Details\Entity\Stock;
use Kompakt\B3d\Details\Endpoint\Cache\DataMapperInterface;

class Mapper implements DataMapperInterface
{
    protected $stockPrototype = null;

    public function __construct(Stock $stockPrototype)
    {
        $this->stockPrototype = $stockPrototype;
    }

    /**
     * @see DataMapperInterface::map()
     */
    public function map(array $data)
    {
        $stock = clone $this->stockPrototype;
        #$stock->setCurrencyId(trim($data['currency_id']));
        return $stock;
    }
}