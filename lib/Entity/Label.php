<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Entity;

class Label
{
    protected $id = null;
    protected $name = null;
    protected $code = null;
    protected $infoEnglish = null;
    protected $infoSecond = null;
    protected $url1 = null;
    protected $url2 = null;
    protected $artwork1 = null;
    protected $artwork2 = null;
    protected $defaultCLine = null;
    protected $defaultPLine = null;
    protected $isrcBase = null;
    protected $territoryId = null;
    protected $notes = null;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function getCode()
    {
        return $this->code;
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

    public function setDefaultCLine($defaultCLine)
    {
        $this->defaultCLine = $defaultCLine;
    }

    public function getDefaultCLine()
    {
        return $this->defaultCLine;
    }

    public function setDefaultPLine($defaultPLine)
    {
        $this->defaultPLine = $defaultPLine;
    }

    public function getDefaultPLine()
    {
        return $this->defaultPLine;
    }

    public function setIsrcBase($isrcBase)
    {
        $this->isrcBase = $isrcBase;
    }

    public function getIsrcBase()
    {
        return $this->isrcBase;
    }

    public function setTerritoryId($territoryId)
    {
        $this->territoryId = $territoryId;
    }

    public function getTerritoryId()
    {
        return $this->territoryId;
    }

    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}