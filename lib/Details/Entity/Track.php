<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Entity;

class Track
{
    // associations
    protected $productTracks = array();

    // properties
    protected $id = null;
    protected $productIdMain = null;
    protected $songId = null;
    protected $country = null;
    protected $artworkTrack1 = null;
    protected $version = null;
    protected $isrc = null;
    protected $pYear = null;
    protected $pLine = null;
    protected $digitalRightType = null;
    protected $artist = null;
    protected $playtime = null;
    protected $title = null;
    protected $type = null;
    protected $explicitFlag = null;

    public function addProductTrack(ProductTrack $productTrack)
    {
        $this->productTracks[] = $productTrack;
    }

    public function getProductTracks()
    {
        return $this->productTracks;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setProductIdMain($productIdMain)
    {
        $this->productIdMain = $productIdMain;
    }

    public function getProductIdMain()
    {
        return $this->productIdMain;
    }

    public function setSongId($songId)
    {
        $this->songId = $songId;
    }

    public function getSongId()
    {
        return $this->songId;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setArtworkTrack1($artworkTrack1)
    {
        $this->artworkTrack1 = $artworkTrack1;
    }

    public function getArtworkTrack1()
    {
        return $this->artworkTrack1;
    }

    public function setVersion($version)
    {
        $this->version = $version;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function setIsrc($isrc)
    {
        $this->isrc = $isrc;
    }

    public function getIsrc()
    {
        return $this->isrc;
    }

    public function setPYear($pYear)
    {
        $this->pYear = $pYear;
    }

    public function getPYear()
    {
        return $this->pYear;
    }

    public function setPLine($pLine)
    {
        $this->pLine = $pLine;
    }

    public function getPLine()
    {
        return $this->pLine;
    }

    public function setDigitalRightType($digitalRightType)
    {
        $this->digitalRightType = $digitalRightType;
    }

    public function getDigitalRightType()
    {
        return $this->digitalRightType;
    }

    public function setArtist($artist)
    {
        $this->artist = $artist;
    }

    public function getArtist()
    {
        return $this->artist;
    }

    public function setPlaytime($playtime)
    {
        $this->playtime = $playtime;
    }

    public function getPlaytime()
    {
        return $this->playtime;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setExplicitFlag($explicitFlag)
    {
        $this->explicitFlag = $explicitFlag;
    }

    public function getExplicitFlag()
    {
        return $this->explicitFlag;
    }
}