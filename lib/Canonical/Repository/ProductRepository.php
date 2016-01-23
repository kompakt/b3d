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
    protected $barcodes = array();
    protected $catalogNumbers = array();

    public function add($product)
    {
        $this->addProduct($product);
    }

    public function getAll()
    {
        return $this->products;
    }

    public function getAllByBarcode($barcode)
    {
        $barcode = $this->prepareField($barcode);

        return
            (array_key_exists($barcode, $this->barcodes))
            ? $this->barcodes[$barcode]
            : array()
        ;
    }

    public function getAllByCatalogNumber($catalogNumber)
    {
        $catalogNumber = $this->prepareField($catalogNumber);

        return
            (array_key_exists($catalogNumber, $this->catalogNumbers))
            ? $this->catalogNumbers[$catalogNumber]
            : array()
        ;
    }

    protected function addProduct(Product $product)
    {
        $this->products[] = $product;
        $this->addByBarcode($product);
        $this->addByCatalogNumber($product);
    }

    protected function addByBarcode(Product $product)
    {
        $barcode = $this->prepareField($product->getBarcode());

        if (!array_key_exists($barcode, $this->barcodes))
        {
            $this->barcodes[$barcode] = array();
        }

        $this->barcodes[$barcode][] = $product;
    }

    protected function addByCatalogNumber(Product $product)
    {
        $catalogNumbers = $this->prepareField($product->getBarcode());

        if (!array_key_exists($catalogNumbers, $this->catalogNumbers))
        {
            $this->catalogNumbers[$catalogNumbers] = array();
        }

        $this->catalogNumbers[$catalogNumbers][] = $product;
    }

    protected function prepareField($s)
    {
        return strtolower(trim($s));
    }
}