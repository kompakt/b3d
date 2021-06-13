<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Entity;

class VatRate
{
    protected $uuid = null;
    protected $formatName = null;
    protected $formatId = null;
    protected $vatClass = null;
    protected $vatClassName = null;
    protected $vatTerritory = null;
    protected $vatRate = null;

    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function setFormatName($formatName)
    {
        $this->formatName = $formatName;
    }

    public function getFormatName()
    {
        return $this->formatName;
    }

    public function setFormatId($formatId)
    {
        $this->formatId = $formatId;
    }

    public function getFormatId()
    {
        return $this->formatId;
    }

    public function setVatClass($vatClass)
    {
        $this->vatClass = $vatClass;
    }

    public function getVatClass()
    {
        return $this->vatClass;
    }

    public function setVatClassName($vatClassName)
    {
        $this->vatClassName = $vatClassName;
    }

    public function getVatClassName()
    {
        return $this->vatClassName;
    }

    public function setVatTerritory($vatTerritory)
    {
        $this->vatTerritory = $vatTerritory;
    }

    public function getVatTerritory()
    {
        return $this->vatTerritory;
    }

    public function setVatRate($vatRate)
    {
        $this->vatRate = $vatRate;
    }

    public function getVatRate()
    {
        return $this->vatRate;
    }
}