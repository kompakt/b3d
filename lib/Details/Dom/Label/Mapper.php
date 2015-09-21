<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Dom\Label;

use Kompakt\B3d\Details\Entity\Label;
use Kompakt\B3d\Util\Dom\AbstractMapper;
use Kompakt\B3d\Details\Populator\MapperInterface as PopulatorMapperInterface;

class Mapper extends AbstractMapper implements PopulatorMapperInterface
{
    protected $labelPrototype = null;

    public function __construct(Label $labelPrototype)
    {
        $this->labelPrototype = $labelPrototype;
    }

    /**
     * @see PopulatorMapperInterface::map()
     */
    public function map(\DOMDocument $dom)
    {
        $label = clone $this->labelPrototype;
        $label->setId($this->getDomVal($dom, 'id'));
        $label->setName($this->getDomVal($dom, 'name'));
        $label->setInfoEnglish($this->getDomVal($dom, 'infoEnglish'));
        $label->setInfoSecond($this->getDomVal($dom, 'infoSecond'));
        $label->setUrl1($this->getDomVal($dom, 'url1'));
        $label->setUrl2($this->getDomVal($dom, 'url2'));
        $label->setArtwork1($this->getDomVal($dom, 'artwork1'));
        $label->setArtwork2($this->getDomVal($dom, 'artwork2'));
        $label->setDefaultCLine($this->getDomVal($dom, 'defaultCLine'));
        $label->setDefaultPLine($this->getDomVal($dom, 'defaultPLine'));
        $label->setIsrcBase($this->getDomVal($dom, 'isrcBase'));
        $label->setTerritoryId($this->getDomVal($dom, 'territoryId'));
        $label->setNotes($this->getDomVal($dom, 'notes'));
        return $label;
    }
}