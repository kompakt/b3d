<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Repository;

use Kompakt\B3d\Details\Entity\Stock;
use Kompakt\B3d\Details\Populator\RepositoryInterface;

class StockRepository implements RepositoryInterface
{
    protected $productUuids = array();

    /**
     * @see RepositoryInterface::add()
     */
    public function add($stock)
    {
        $this->addStock($stock);
    }

    public function getByProductUuid($productUuid)
    {
        return
            (array_key_exists($productUuid, $this->productUuids))
            ? $this->productUuids[$productUuid]
            : null
        ;
    }

    public function getAll()
    {
        return $this->productUuids;
    }

    protected function addStock(Stock $stock)
    {
        $this->productUuids[$stock->getProductUuid()] = $stock;
    }
}