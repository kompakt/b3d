<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Repository;

use Kompakt\B3d\Details\Entity\Product;
use Kompakt\B3d\Details\Populator\RepositoryInterface;

class ProductRepository implements RepositoryInterface
{
    protected $productIds = array();
    protected $releaseIds = array();

    /**
     * @see RepositoryInterface::add()
     */
    public function add($product)
    {
        $this->addProduct($product);
    }

    public function getByProductId($productId)
    {
        return
            (array_key_exists($productId, $this->productIds))
            ? $this->productIds[$productId]
            : null
        ;
    }

    public function getAllByReleaseId($releaseId)
    {
        return
            (array_key_exists($releaseId, $this->releaseIds))
            ? $this->releaseIds[$releaseId]
            : array()
        ;
    }

    public function getAll()
    {
        return $this->productIds;
    }

    protected function addProduct(Product $product)
    {
        $this->productIds[$product->getProductId()] = $product;

        if (!array_key_exists($product->getReleaseId(), $this->releaseIds))
        {
            $this->releaseIds[$product->getReleaseId()] = array();
        }

        $this->releaseIds[$product->getReleaseId()][] = $product;
    }
}