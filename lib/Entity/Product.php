<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Entity;

class Product
{
    protected $streamYesNo = null;
    protected $identifier = null;
    protected $digitalPhysical = null;
    protected $supplierId = null;
    protected $weight = null;
    protected $releaseShift = null;
    protected $infoEnglish = null;
    protected $infoSecond = null;
    protected $releaseId = null;
    protected $lastModified = null;
    protected $downloadYesNo = null;
    protected $deliveryNow = null;
    protected $deliveryConfirmedDate = null;
    protected $barcode = null;
    protected $deliveredFlag = null;
    protected $deliveredDate = null;
    protected $deliveryConfirmedFlag = null;
    protected $attribute1 = null;
    protected $attribute2 = null;
    protected $attribute3 = null;
    protected $formatId = null;
    protected $artworkProduct1 = null;
    protected $artworkProduct2 = null;
    protected $priceCodeId = null;
    protected $language = null;
    protected $ppd = null;
    protected $version = null;
    protected $costPrice = null;
    protected $notes = null;
    protected $typeId = null;
    protected $catalogNumber = null;

    public function setCatalogNumber($catalogNumber)
    {
        $this->catalogNumber = $catalogNumber;
    }

    public function getCatalogNumber()
    {
        return $this->catalogNumber;
    }
}