<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Canonical\Entity;

use Kompakt\B3d\Canonical\Entity\Price;
use Kompakt\B3d\Canonical\Entity\Track;

class Product
{
    // helpers
    protected $albumSingleMerchValAlbum = 'album';
    protected $albumSingleMerchValSingle = 'single';
    protected $albumSingleMerchValMerch = 'merchandise';
    protected $channelValPhysical = 'physical';
    protected $channelValDigital = 'digital';

    public function isAlbum()
    {
        return ($this->getAlbumSingleMerch() === $this->albumSingleMerchValAlbum);
    }

    public function isSingle()
    {
        return ($this->getAlbumSingleMerch() === $this->albumSingleMerchValSingle);
    }

    public function isMerch()
    {
        return ($this->getAlbumSingleMerch() === $this->albumSingleMerchValMerch);
    }

    public function isPhysical()
    {
        return ($this->getChannel() === $this->channelValPhysical);
    }

    public function isDigital()
    {
        return ($this->getChannel() === $this->channelValDigital);
    }

    // associations
    protected $tracks = array();

    public function addTrack(Track $track)
    {
        $this->tracks[] = $track;
    }

    public function getTracks()
    {
        return $this->tracks;
    }

    protected $prices = array();

    public function addPrice(Price $price)
    {
        $this->prices[] = $price;
    }

    public function getPrices()
    {
        return $this->prices;
    }

    // label-fields
    protected $label = null;

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function getLabel()
    {
        return $this->label;
    }

    // release-fields
    protected $releaseUuid = null;
    protected $releaseArtwork1 = null;
    protected $releaseArtwork2 = null;
    protected $releaseIdentifier = null;
    protected $releaseLabelId = null;
    protected $releaseNotes = null;
    protected $releaseProjectId = null;
    protected $releaseArtist = null;
    protected $releaseDate = null;
    protected $releaseId = null;
    protected $releaseInfoEnglish = null;
    protected $releaseInfoSecond = null;
    protected $releaseTitle = null;
    protected $releaseTitleAlt = null;
    protected $releaseType = null;
    protected $releaseStatus = null;

    public function setReleaseUuid($releaseUuid)
    {
        $this->releaseUuid = $releaseUuid;
    }

    public function getReleaseUuid()
    {
        return $this->releaseUuid;
    }

    public function setReleaseArtwork1($releaseArtwork1)
    {
        $this->releaseArtwork1 = $releaseArtwork1;
    }

    public function getReleaseArtwork1()
    {
        return $this->releaseArtwork1;
    }

    public function setReleaseArtwork2($releaseArtwork2)
    {
        $this->releaseArtwork2 = $releaseArtwork2;
    }

    public function getReleaseArtwork2()
    {
        return $this->releaseArtwork2;
    }

    public function setReleaseIdentifier($releaseIdentifier)
    {
        $this->releaseIdentifier = $releaseIdentifier;
    }

    public function getReleaseIdentifier()
    {
        return $this->releaseIdentifier;
    }

    public function setReleaseLabelId($releaseLabelId)
    {
        $this->releaseLabelId = $releaseLabelId;
    }

    public function getReleaseLabelId()
    {
        return $this->releaseLabelId;
    }

    public function setReleaseNotes($releaseNotes)
    {
        $this->releaseNotes = $releaseNotes;
    }

    public function getReleaseNotes()
    {
        return $this->releaseNotes;
    }

    public function setReleaseProjectId($releaseProjectId)
    {
        $this->releaseProjectId = $releaseProjectId;
    }

    public function getReleaseProjectId()
    {
        return $this->releaseProjectId;
    }

    public function setReleaseArtist($releaseArtist)
    {
        $this->releaseArtist = $releaseArtist;
    }

    public function getReleaseArtist()
    {
        return $this->releaseArtist;
    }

    public function setReleaseDate(\DateTime $releaseDate)
    {
        $this->releaseDate = $releaseDate;
    }

    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    public function setReleaseId($releaseId)
    {
        $this->releaseId = $releaseId;
    }

    public function getReleaseId()
    {
        return $this->releaseId;
    }

    public function setReleaseInfoEnglish($releaseInfoEnglish)
    {
        $this->releaseInfoEnglish = $releaseInfoEnglish;
    }

    public function getReleaseInfoEnglish()
    {
        return $this->releaseInfoEnglish;
    }

    public function setReleaseInfoSecond($releaseInfoSecond)
    {
        $this->releaseInfoSecond = $releaseInfoSecond;
    }

    public function getReleaseInfoSecond()
    {
        return $this->releaseInfoSecond;
    }

    public function setReleaseTitle($releaseTitle)
    {
        $this->releaseTitle = $releaseTitle;
    }

    public function getReleaseTitle()
    {
        return $this->releaseTitle;
    }

    public function setReleaseTitleAlt($releaseTitleAlt)
    {
        $this->releaseTitleAlt = $releaseTitleAlt;
    }

    public function getReleaseTitleAlt()
    {
        return $this->releaseTitleAlt;
    }

    public function setReleaseType($releaseType)
    {
        $this->releaseType = $releaseType;
    }

    public function getReleaseType()
    {
        return $this->releaseType;
    }

    public function setReleaseStatus($releaseStatus)
    {
        $this->releaseStatus = $releaseStatus;
    }

    public function getReleaseStatus()
    {
        return $this->releaseStatus;
    }

    // product-fields
    protected $uuid = null;
    protected $altArtist = null;
    protected $altTitle = null;
    protected $productDate = null;
    protected $albumSingleMerch = null;
    protected $artworkProduct1 = null;
    protected $artworkProduct2 = null;
    protected $attribute1 = null;
    protected $attribute2 = null;
    protected $attribute3 = null;
    protected $barcode = null;
    protected $catalogNumber = null;
    protected $channel = null;
    protected $costPrice = null;
    protected $defaultWeight = null;
    protected $deliveredDate = null;
    protected $deliveredFlag = null;
    protected $deliveryConfirmedDate = null;
    protected $deliveryConfirmedFlag = null;
    protected $deliveryNow = null;
    protected $digitalPhysical = null;
    protected $downloadYesNo = null;
    protected $formatId = null;
    protected $formatName = null;
    protected $groups = null;
    protected $headline = null;
    protected $identifier = null;
    protected $internalFlag = null;
    protected $language = null;
    protected $minMargin = null;
    protected $notes = null;
    protected $ppd = null;
    protected $priceCodeDescription = null;
    protected $priceCodeId = null;
    protected $priceCodeName = null;
    protected $productId = null;
    protected $productInfoEnglish = null;
    protected $productInfoSecond = null;
    protected $productTypeId = null;
    protected $productTypeName = null;
    protected $productTypeId2 = null;
    protected $productTypeName2 = null;
    protected $proformaPrice = null;
    #protected $releaseId = null;
    protected $releaseShift = null;
    protected $streamYesNo = null;
    protected $supplierId = null;
    protected $twoSidesFlag = null;
    protected $vatType = null;
    protected $version = null;
    protected $weight = null;

    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function setAltArtist($altArtist)
    {
        $this->altArtist = $altArtist;
    }

    public function getAltArtist()
    {
        return $this->altArtist;
    }

    public function setAltTitle($altTitle)
    {
        $this->altTitle = $altTitle;
    }

    public function getAltTitle()
    {
        return $this->altTitle;
    }

    public function setProductDate(\DateTime $productDate)
    {
        $this->productDate = $productDate;
    }

    public function getProductDate()
    {
        return $this->productDate;
    }

    public function setAlbumSingleMerch($albumSingleMerch)
    {
        $this->albumSingleMerch = $albumSingleMerch;
    }

    public function getAlbumSingleMerch()
    {
        return $this->albumSingleMerch;
    }

    public function setArtworkProduct1($artworkProduct1)
    {
        $this->artworkProduct1 = $artworkProduct1;
    }

    public function getArtworkProduct1()
    {
        return $this->artworkProduct1;
    }

    public function setArtworkProduct2($artworkProduct2)
    {
        $this->artworkProduct2 = $artworkProduct2;
    }

    public function getArtworkProduct2()
    {
        return $this->artworkProduct2;
    }

    public function setAttribute1($attribute1)
    {
        $this->attribute1 = $attribute1;
    }

    public function getAttribute1()
    {
        return $this->attribute1;
    }

    public function setAttribute2($attribute2)
    {
        $this->attribute2 = $attribute2;
    }

    public function getAttribute2()
    {
        return $this->attribute2;
    }

    public function setAttribute3($attribute3)
    {
        $this->attribute3 = $attribute3;
    }

    public function getAttribute3()
    {
        return $this->attribute3;
    }

    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
    }

    public function getBarcode()
    {
        return $this->barcode;
    }

    public function setCatalogNumber($catalogNumber)
    {
        $this->catalogNumber = $catalogNumber;
    }

    public function getCatalogNumber()
    {
        return $this->catalogNumber;
    }

    public function setChannel($channel)
    {
        $this->channel = $channel;
    }

    public function getChannel()
    {
        return $this->channel;
    }

    public function setCostPrice($costPrice)
    {
        $this->costPrice = $costPrice;
    }

    public function getCostPrice()
    {
        return $this->costPrice;
    }

    public function setDefaultWeight($defaultWeight)
    {
        $this->defaultWeight = $defaultWeight;
    }

    public function getDefaultWeight()
    {
        return $this->defaultWeight;
    }

    public function setDeliveredDate($deliveredDate)
    {
        $this->deliveredDate = $deliveredDate;
    }

    public function getDeliveredDate()
    {
        return $this->deliveredDate;
    }

    public function setDeliveredFlag($deliveredFlag)
    {
        $this->deliveredFlag = $deliveredFlag;
    }

    public function getDeliveredFlag()
    {
        return $this->deliveredFlag;
    }

    public function setDeliveryConfirmedDate($deliveryConfirmedDate)
    {
        $this->deliveryConfirmedDate = $deliveryConfirmedDate;
    }

    public function getDeliveryConfirmedDate()
    {
        return $this->deliveryConfirmedDate;
    }

    public function setDeliveryConfirmedFlag($deliveryConfirmedFlag)
    {
        $this->deliveryConfirmedFlag = $deliveryConfirmedFlag;
    }

    public function getDeliveryConfirmedFlag()
    {
        return $this->deliveryConfirmedFlag;
    }

    public function setDeliveryNow($deliveryNow)
    {
        $this->deliveryNow = $deliveryNow;
    }

    public function getDeliveryNow()
    {
        return $this->deliveryNow;
    }

    public function setDigitalPhysical($digitalPhysical)
    {
        $this->digitalPhysical = $digitalPhysical;
    }

    public function getDigitalPhysical()
    {
        return $this->digitalPhysical;
    }

    public function setDownloadYesNo($downloadYesNo)
    {
        $this->downloadYesNo = $downloadYesNo;
    }

    public function getDownloadYesNo()
    {
        return $this->downloadYesNo;
    }

    public function setFormatId($formatId)
    {
        $this->formatId = $formatId;
    }

    public function getFormatId()
    {
        return $this->formatId;
    }

    public function setFormatName($formatName)
    {
        $this->formatName = $formatName;
    }

    public function getFormatName()
    {
        return $this->formatName;
    }

    public function setGroups($groups)
    {
        $this->groups = $groups;
    }

    public function getGroups()
    {
        return $this->groups;
    }

    public function setHeadline($headline)
    {
        $this->headline = $headline;
    }

    public function getHeadline()
    {
        return $this->headline;
    }

    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function setInternalFlag($internalFlag)
    {
        $this->internalFlag = $internalFlag;
    }

    public function getInternalFlag()
    {
        return $this->internalFlag;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setMinMargin($minMargin)
    {
        $this->minMargin = $minMargin;
    }

    public function getMinMargin()
    {
        return $this->minMargin;
    }

    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function setPpd($ppd)
    {
        $this->ppd = $ppd;
    }

    public function getPpd()
    {
        return $this->ppd;
    }

    public function setPriceCodeDescription($priceCodeDescription)
    {
        $this->priceCodeDescription = $priceCodeDescription;
    }

    public function getPriceCodeDescription()
    {
        return $this->priceCodeDescription;
    }

    public function setPriceCodeId($priceCodeId)
    {
        $this->priceCodeId = $priceCodeId;
    }

    public function getPriceCodeId()
    {
        return $this->priceCodeId;
    }

    public function setPriceCodeName($priceCodeName)
    {
        $this->priceCodeName = $priceCodeName;
    }

    public function getPriceCodeName()
    {
        return $this->priceCodeName;
    }

    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function setProductInfoEnglish($productInfoEnglish)
    {
        $this->productInfoEnglish = $productInfoEnglish;
    }

    public function getProductInfoEnglish()
    {
        return $this->productInfoEnglish;
    }

    public function setProductInfoSecond($productInfoSecond)
    {
        $this->productInfoSecond = $productInfoSecond;
    }

    public function getProductInfoSecond()
    {
        return $this->productInfoSecond;
    }

    public function setProductTypeId($productTypeId)
    {
        $this->productTypeId = $productTypeId;
    }

    public function getProductTypeId()
    {
        return $this->productTypeId;
    }

    public function setProductTypeName($productTypeName)
    {
        $this->productTypeName = $productTypeName;
    }

    public function getProductTypeName()
    {
        return $this->productTypeName;
    }

    public function setProductTypeId2($productTypeId2)
    {
        $this->productTypeId2 = $productTypeId2;
    }

    public function getProductTypeId2()
    {
        return $this->productTypeId2;
    }

    public function setProductTypeName2($productTypeName2)
    {
        $this->productTypeName2 = $productTypeName2;
    }

    public function getProductTypeName2()
    {
        return $this->productTypeName2;
    }

    public function setProformaPrice($proformaPrice)
    {
        $this->proformaPrice = $proformaPrice;
    }

    public function getProformaPrice()
    {
        return $this->proformaPrice;
    }

    /*public function setReleaseId($releaseId)
    {
        $this->releaseId = $releaseId;
    }

    public function getReleaseId()
    {
        return $this->releaseId;
    }*/

    public function setReleaseShift($releaseShift)
    {
        $this->releaseShift = $releaseShift;
    }

    public function getReleaseShift()
    {
        return $this->releaseShift;
    }

    public function setStreamYesNo($streamYesNo)
    {
        $this->streamYesNo = $streamYesNo;
    }

    public function getStreamYesNo()
    {
        return $this->streamYesNo;
    }

    public function setSupplierId($supplierId)
    {
        $this->supplierId = $supplierId;
    }

    public function getSupplierId()
    {
        return $this->supplierId;
    }

    public function setTwoSidesFlag($twoSidesFlag)
    {
        $this->twoSidesFlag = $twoSidesFlag;
    }

    public function getTwoSidesFlag()
    {
        return $this->twoSidesFlag;
    }

    public function setVatType($vatType)
    {
        $this->vatType = $vatType;
    }

    public function getVatType()
    {
        return $this->vatType;
    }

    public function setVersion($version)
    {
        $this->version = $version;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function getWeight()
    {
        return $this->weight;
    }
}