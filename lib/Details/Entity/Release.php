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

    protected $status = null;
    protected $title = null;
    protected $titleAlt = null;
    protected $infoEnglish = null;
    protected $infoSecond = null;
    protected $identifier = null;
    protected $artist = null;
    protected $artwork1 = null;
    protected $artwork2 = null;
    protected $projectId = null;
    protected $id = null;
    protected $releaseDate = null;
    protected $type = null;
    protected $notes = null;
    protected $labelId = null;

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

    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

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

    public function setProjectId($projectId)
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
    }

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

    public function setLabelId($labelId)
    {
        $this->labelId = $labelId;
    }

    public function getLabelId()
    {
        return $this->labelId;
    }
}