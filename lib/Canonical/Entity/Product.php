<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Canonical\Entity;

use Kompakt\B3d\Canonical\Entity\Track;

class Product
{
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
    protected $status = null;
    protected $title = null;
    protected $titleAlt = null;
    protected $infoEnglish = null;
    protected $infoSecond = null;
    #protected $identifier = null;
    protected $artist = null;
    protected $artwork1 = null;
    protected $artwork2 = null;
    #protected $projectId = null;
    #protected $id = null;
    protected $releaseDate = null;
    protected $type = null;
    protected $notes = null;
    #protected $labelId = null;

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

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitleAlt($titleAlt)
    {
        $this->titleAlt = $titleAlt;
    }

    public function getTitleAlt()
    {
        return $this->titleAlt;
    }

    public function setInfoEnglish($infoEnglish)
    {
        $this->infoEnglish = $infoEnglish;
    }

    public function getInfoEnglish()
    {
        return $this->infoEnglish;
    }

    public function setInfoSecond($infoSecond)
    {
        $this->infoSecond = $infoSecond;
    }

    public function getInfoSecond()
    {
        return $this->infoSecond;
    }

    /*public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }*/

    public function setArtist($artist)
    {
        $this->artist = $artist;
    }

    public function getArtist()
    {
        return $this->artist;
    }

    public function setArtwork1($artwork1)
    {
        $this->artwork1 = $artwork1;
    }

    public function getArtwork1()
    {
        return $this->artwork1;
    }

    public function setArtwork2($artwork2)
    {
        $this->artwork2 = $artwork2;
    }

    public function getArtwork2()
    {
        return $this->artwork2;
    }

    /*public function setProjectId($projectId)
    {
        $this->projectId = $projectId;
    }

    public function getProjectId()
    {
        return $this->projectId;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }*/

    public function setReleaseDate(\DateTime $releaseDate)
    {
        $this->releaseDate = $releaseDate;
    }

    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    /*public function setLabelId($labelId)
    {
        $this->labelId = $labelId;
    }

    public function getLabelId()
    {
        return $this->labelId;
    }*/

    // product-fields
    #protected $id = null;
    protected $catalogNumber = null;
    protected $streamYesNo = null;
    #protected $identifier = null;
    protected $digitalPhysical = null;
    #protected $supplierId = null;
    protected $weight = null;
    protected $releaseShift = null;
    #protected $infoEnglish = null;
    #protected $infoSecond = null;
    #protected $releaseId = null;
    protected $downloadYesNo = null;
    #protected $deliveryNow = null;
    #protected $deliveryConfirmedDate = null;
    protected $barcode = null;
    #protected $deliveredFlag = null;
    #protected $deliveredDate = null;
    #protected $deliveryConfirmedFlag = null;
    protected $attribute1 = null;
    protected $attribute2 = null;
    protected $attribute3 = null;
    #protected $formatId = null; // <<
    protected $artworkProduct1 = null;
    protected $artworkProduct2 = null;
    #protected $priceCodeId = null; // <<
    protected $language = null;
    protected $ppd = null;
    protected $version = null;
    protected $costPrice = null;
    #protected $notes = null;
    #protected $typeId = null; // <<

    /*public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }*/

    public function setCatalogNumber($catalogNumber)
    {
        $this->catalogNumber = $catalogNumber;
    }

    public function getCatalogNumber()
    {
        return $this->catalogNumber;
    }

    public function setStreamYesNo($streamYesNo)
    {
        $this->streamYesNo = $streamYesNo;
    }

    public function getStreamYesNo()
    {
        return $this->streamYesNo;
    }

    /*public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }*/

    public function setDigitalPhysical($digitalPhysical)
    {
        $this->digitalPhysical = $digitalPhysical;
    }

    public function getDigitalPhysical()
    {
        return $this->digitalPhysical;
    }

    /*public function setSupplierId($supplierId)
    {
        $this->supplierId = $supplierId;
    }

    public function getSupplierId()
    {
        return $this->supplierId;
    }*/

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setReleaseShift($releaseShift)
    {
        $this->releaseShift = $releaseShift;
    }

    public function getReleaseShift()
    {
        return $this->releaseShift;
    }

    /*public function setInfoEnglish($infoEnglish)
    {
        $this->infoEnglish = $infoEnglish;
    }

    public function getInfoEnglish()
    {
        return $this->infoEnglish;
    }

    public function setInfoSecond($infoSecond)
    {
        $this->infoSecond = $infoSecond;
    }

    public function getInfoSecond()
    {
        return $this->infoSecond;
    }*/

    /*public function setReleaseId($releaseId)
    {
        $this->releaseId = $releaseId;
    }

    public function getReleaseId()
    {
        return $this->releaseId;
    }*/

    public function setDownloadYesNo($downloadYesNo)
    {
        $this->downloadYesNo = $downloadYesNo;
    }

    public function getDownloadYesNo()
    {
        return $this->downloadYesNo;
    }

    /*public function setDeliveryNow($deliveryNow)
    {
        $this->deliveryNow = $deliveryNow;
    }

    public function getDeliveryNow()
    {
        return $this->deliveryNow;
    }

    public function setDeliveryConfirmedDate($deliveryConfirmedDate)
    {
        $this->deliveryConfirmedDate = $deliveryConfirmedDate;
    }

    public function getDeliveryConfirmedDate()
    {
        return $this->deliveryConfirmedDate;
    }*/

    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
    }

    public function getBarcode()
    {
        return $this->barcode;
    }

    /*public function setDeliveredFlag($deliveredFlag)
    {
        $this->deliveredFlag = $deliveredFlag;
    }

    public function getDeliveredFlag()
    {
        return $this->deliveredFlag;
    }

    public function setDeliveredDate($deliveredDate)
    {
        $this->deliveredDate = $deliveredDate;
    }

    public function getDeliveredDate()
    {
        return $this->deliveredDate;
    }

    public function setDeliveryConfirmedFlag($deliveryConfirmedFlag)
    {
        $this->deliveryConfirmedFlag = $deliveryConfirmedFlag;
    }

    public function getDeliveryConfirmedFlag()
    {
        return $this->deliveryConfirmedFlag;
    }*/

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

    /*public function setFormatId($formatId)
    {
        $this->formatId = $formatId;
    }

    public function getFormatId()
    {
        return $this->formatId;
    }*/

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

    /*public function setPriceCodeId($priceCodeId)
    {
        $this->priceCodeId = $priceCodeId;
    }

    public function getPriceCodeId()
    {
        return $this->priceCodeId;
    }*/

    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setPpd($ppd)
    {
        $this->ppd = $ppd;
    }

    public function getPpd()
    {
        return $this->ppd;
    }

    public function setVersion($version)
    {
        $this->version = $version;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function setCostPrice($costPrice)
    {
        $this->costPrice = $costPrice;
    }

    public function getCostPrice()
    {
        return $this->costPrice;
    }

    /*public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    public function getNotes()
    {
        return $this->notes;
    }*/

    /*public function setTypeId($typeId)
    {
        $this->typeId = $typeId;
    }

    public function getTypeId()
    {
        return $this->typeId;
    }*/
}