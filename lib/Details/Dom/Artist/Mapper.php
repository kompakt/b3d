<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Dom\Artist;

use Kompakt\B3d\Details\Entity\Artist;
use Kompakt\B3d\Util\Dom\AbstractMapper;
use Kompakt\B3d\Details\Populator\MapperInterface as PopulatorMapperInterface;

class Mapper extends AbstractMapper implements PopulatorMapperInterface
{
    protected $artistPrototype = null;

    public function __construct(Artist $artistPrototype)
    {
        $this->artistPrototype = $artistPrototype;
    }

    /**
     * @see PopulatorMapperInterface::map()
     */
    public function map(\DOMDocument $dom)
    {
        $artist = clone $this->artistPrototype;
        $artist->setName($this->getDomVal($dom, 'name'));
        $artist->setMechanicalId($this->getDomVal($dom, 'mechanicalId'));
        $artist->setBioEngl($this->getDomVal($dom, 'bioEngl'));
        $artist->setBioOwn($this->getDomVal($dom, 'bioOwn'));
        $artist->setNotes($this->getDomVal($dom, 'notes'));
        $artist->setArtwork1($this->getDomVal($dom, 'artwork1'));
        $artist->setArtwork2($this->getDomVal($dom, 'artwork2'));
        $artist->setUrl1($this->getDomVal($dom, 'url1'));
        $artist->setUrl2($this->getDomVal($dom, 'url2'));
        $artist->setLabelArtistId($this->getDomVal($dom, 'labelArtistId'));
        $artist->setSortName($this->getDomVal($dom, 'sortName'));
        $artist->setAmgId($this->getDomVal($dom, 'amgId'));
        return $artist;
    }
}