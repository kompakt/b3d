<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Entity;

use Kompakt\B3d\Details\Entity\Product;

class Price
{
    // associations
    protected $product = null;

    // properties
    protected $currencyId = null;
    protected $currencyIso = null;
    protected $externalTable = null;
    protected $payback = null;
    protected $price = null;
    protected $pricelistId = null;
    protected $pricelistName = null;
    protected $productId = null;
    protected $productPriceId = null;

    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setCurrencyId($currencyId)
    {
        $this->currencyId = $currencyId;
    }

    public function getCurrencyId()
    {
        return $this->currencyId;
    }

    public function setCurrencyIso($currencyIso)
    {
        $this->currencyIso = $currencyIso;
    }

    public function getCurrencyIso()
    {
        return $this->currencyIso;
    }

    public function setExternalTable($externalTable)
    {
        $this->externalTable = $externalTable;
    }

    public function getExternalTable()
    {
        return $this->externalTable;
    }

    public function setPayback($payback)
    {
        $this->payback = $payback;
    }

    public function getPayback()
    {
        return $this->payback;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPricelistId($pricelistId)
    {
        $this->pricelistId = $pricelistId;
    }

    public function getPricelistId()
    {
        return $this->pricelistId;
    }

    public function setPricelistName($pricelistName)
    {
        $this->pricelistName = $pricelistName;
    }

    public function getPricelistName()
    {
        return $this->pricelistName;
    }

    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function setProductPriceId($productPriceId)
    {
        $this->productPriceId = $productPriceId;
    }

    public function getProductPriceId()
    {
        return $this->productPriceId;
    }
}