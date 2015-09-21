<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Entity;

class Artist
{
    protected $name = null;
    protected $mechanicalId = null;
    protected $bioEngl = null;
    protected $bioOwn = null;
    protected $notes = null;
    protected $artwork1 = null;
    protected $artwork2 = null;
    protected $url1 = null;
    protected $url2 = null;
    protected $labelArtistId = null;
    protected $sortName = null;
    protected $amgId = null;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setMechanicalId($mechanicalId)
    {
        $this->mechanicalId = $mechanicalId;
    }

    public function getMechanicalId()
    {
        return $this->mechanicalId;
    }

    public function setBioEngl($bioEngl)
    {
        $this->bioEngl = $bioEngl;
    }

    public function getBioEngl()
    {
        return $this->bioEngl;
    }

    public function setBioOwn($bioOwn)
    {
        $this->bioOwn = $bioOwn;
    }

    public function getBioOwn()
    {
        return $this->bioOwn;
    }

    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    public function getNotes()
    {
        return $this->notes;
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

    public function setUrl1($url1)
    {
        $this->url1 = $url1;
    }

    public function getUrl1()
    {
        return $this->url1;
    }

    public function setUrl2($url2)
    {
        $this->url2 = $url2;
    }

    public function getUrl2()
    {
        return $this->url2;
    }

    public function setLabelArtistId($labelArtistId)
    {
        $this->labelArtistId = $labelArtistId;
    }

    public function getLabelArtistId()
    {
        return $this->labelArtistId;
    }

    public function setSortName($sortName)
    {
        $this->sortName = $sortName;
    }

    public function getSortName()
    {
        return $this->sortName;
    }

    public function setAmgId($amgId)
    {
        $this->amgId = $amgId;
    }

    public function getAmgId()
    {
        return $this->amgId;
    }
}