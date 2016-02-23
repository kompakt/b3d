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
    protected $products = [];
    protected $barcodes = [];
    protected $catalogNumbers = [];
    protected $releaseTitles = [];

    public function clear()
    {
        $this->products = [];
        $this->barcodes = [];
        $this->catalogNumbers = [];
        $this->releaseTitles = [];
    }

    public function add($product)
    {
        $this->addProduct($product);
    }

    public function getAll()
    {
        return $this->products;
    }

    public function getSlice($first, $max)
    {
        $first = (int) $first;
        $first = ($first < 0) ? 0 : $first;
        $max = (int) $max;
        $max = ($max < 0) ? 0 : $max;
        $products = [];
        $i = -1;

        foreach ($this->products as $product)
        {
            $i++;

            if ($i < $first)
            {
                continue;
            }

            if ($i > $first + $max - 1)
            {
                break;
            }

            $products[] = $product;
        }

        return $products;
    }

    public function getByUuid($uuid)
    {
        $uuid = $this->prepareField($uuid);

        return
            (array_key_exists($uuid, $this->products))
            ? $this->products[$uuid]
            : null
        ;
    }

    public function getAllByBarcode($barcode)
    {
        $barcode = $this->prepareField($barcode);

        return
            (array_key_exists($barcode, $this->barcodes))
            ? $this->barcodes[$barcode]
            : []
        ;
    }

    public function getAllByCatalogNumber($catalogNumber)
    {
        $catalogNumber = $this->prepareField($catalogNumber);

        return
            (array_key_exists($catalogNumber, $this->catalogNumbers))
            ? $this->catalogNumbers[$catalogNumber]
            : []
        ;
    }

    public function getAllByReleaseTitle($releaseTitle)
    {
        $releaseTitle = $this->prepareField($releaseTitle);

        return
            (array_key_exists($releaseTitle, $this->releaseTitles))
            ? $this->releaseTitles[$releaseTitle]
            : []
        ;
    }

    protected function addProduct(Product $product)
    {
        $this->products[$product->getUuid()] = $product;
        $this->addByBarcode($product);
        $this->addByCatalogNumber($product);
        $this->addByReleaseTitle($product);
    }

    protected function addByBarcode(Product $product)
    {
        $barcode = $this->prepareField($product->getBarcode());

        if (!array_key_exists($barcode, $this->barcodes))
        {
            $this->barcodes[$barcode] = [];
        }

        $this->barcodes[$barcode][] = $product;
    }

    protected function addByCatalogNumber(Product $product)
    {
        $catalogNumber = $this->prepareField($product->getCatalogNumber());

        if (!array_key_exists($catalogNumber, $this->catalogNumbers))
        {
            $this->catalogNumbers[$catalogNumber] = [];
        }

        $this->catalogNumbers[$catalogNumber][] = $product;
    }

    protected function addByReleaseTitle(Product $product)
    {
        $releaseTitle = $this->prepareField($product->getReleaseTitle());

        if (!array_key_exists($releaseTitle, $this->releaseTitles))
        {
            $this->releaseTitles[$releaseTitle] = [];
        }

        $this->releaseTitles[$releaseTitle][] = $product;
    }

    protected function prepareField($s)
    {
        return preg_replace('/\s+/', ' ', strtolower(trim($s)));
    }
}