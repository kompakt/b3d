<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Repository;

use Kompakt\B3d\Details\Entity\Price;
use Kompakt\B3d\Details\Populator\RepositoryInterface;

class PriceRepository implements RepositoryInterface
{
    protected $productIds = array();

    /**
     * @see RepositoryInterface::add()
     */
    public function add($price)
    {
        $this->addPrice($price);
    }

    public function getAllByProductId($productId)
    {
        return
            (array_key_exists($productId, $this->productIds))
            ? $this->productIds[$productId]
            : []
        ;
    }

    public function getAll()
    {
        return $this->productIds;
    }

    protected function addPrice(Price $price)
    {
        if (!array_key_exists($price->getProductId(), $this->productIds))
        {
            $this->productIds[$price->getProductId()] = array();
        }

        $this->productIds[$price->getProductId()][] = $price;
    }
}