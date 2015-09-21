<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Canonical\Repository;

use Kompakt\B3d\Canonical\Entity\Product;

class ProductRepository
{
    protected $products = array();

    /**
     * @see RepositoryInterface::add()
     */
    public function add($product)
    {
        $this->addProduct($product);
    }

    public function getAll()
    {
        return $this->products;
    }

    protected function addProduct(Product $product)
    {
        $this->products[] = $product;
    }
}