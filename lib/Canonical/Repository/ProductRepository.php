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
    protected $releaseTitles = array();

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

    public function getAllByReleaseTitle($releaseTitle)
    {
        $releaseTitle = $this->prepareField($releaseTitle);

        return
            (array_key_exists($releaseTitle, $this->releaseTitles))
            ? $this->releaseTitles[$releaseTitle]
            : array()
        ;
    }

    protected function addProduct(Product $product)
    {
        $this->products[] = $product;
        $this->addByBarcode($product);
        $this->addByCatalogNumber($product);
        $this->addByReleaseTitle($product);
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
        $catalogNumber = $this->prepareField($product->getCatalogNumber());

        if (!array_key_exists($catalogNumber, $this->catalogNumbers))
        {
            $this->catalogNumbers[$catalogNumber] = array();
        }

        $this->catalogNumbers[$catalogNumber][] = $product;
    }

    protected function addByReleaseTitle(Product $product)
    {
        $releaseTitle = $this->prepareField($product->getReleaseTitle());

        if (!array_key_exists($releaseTitle, $this->releaseTitles))
        {
            $this->releaseTitles[$releaseTitle] = array();
        }

        $this->releaseTitles[$releaseTitle][] = $product;
    }

    protected function prepareField($s)
    {
        return preg_replace('/\s+/', ' ', strtolower(trim($s)));
    }
}