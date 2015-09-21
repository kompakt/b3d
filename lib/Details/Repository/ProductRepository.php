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
    protected $ids = array();
    protected $releaseIds = array();

    /**
     * @see RepositoryInterface::add()
     */
    public function add($product)
    {
        $this->addProduct($product);
    }

    public function getById($id)
    {
        return
            (array_key_exists($id, $this->ids))
            ? $this->ids[$id]
            : null
        ;
    }

    public function getAllByReleaseId($id)
    {
        return
            (array_key_exists($id, $this->releaseIds))
            ? $this->releaseIds[$id]
            : array()
        ;
    }

    public function getAll()
    {
        return $this->ids;
    }

    protected function addProduct(Product $product)
    {
        $this->ids[$product->getId()] = $product;

        if (!array_key_exists($product->getReleaseId(), $this->releaseIds))
        {
            $this->releaseIds[$product->getReleaseId()] = array();
        }

        $this->releaseIds[$product->getReleaseId()][] = $product;
    }
}