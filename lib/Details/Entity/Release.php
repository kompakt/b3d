<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Entity;

use Kompakt\B3d\Details\Entity\Label;
use Kompakt\B3d\Details\Entity\Product;

class Release
{
    // associations
    protected $products = array();
    protected $label = null;

    protected $uuid = null;
    protected $artwork1 = null;
    protected $artwork2 = null;
    protected $identifier = null;
    protected $labelId = null;
    protected $notes = null;
    protected $projectId = null;
    protected $releaseArtist = null;
    protected $releaseDate = null;
    protected $releaseId = null;
    protected $releaseInfoEnglish = null;
    protected $releaseInfoSecond = null;
    protected $releaseTitle = null;
    protected $releaseTitleAlt = null;
    protected $releaseType = null;
    protected $status = null;

    public function setLabel(Label $label)
    {
        $this->label = $label;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    public function getUuid()
    {
        return $this->uuid;
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

    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function setLabelId($labelId)
    {
        $this->labelId = $labelId;
    }

    public function getLabelId()
    {
        return $this->labelId;
    }

    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;
    }

    public function getProjectId()
    {
        return $this->projectId;
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

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }
}