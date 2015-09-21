<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Dom\Track;

use Kompakt\B3d\Details\Entity\Track;
use Kompakt\B3d\Util\Dom\AbstractMapper;
use Kompakt\B3d\Details\Populator\MapperInterface as PopulatorMapperInterface;

class Mapper extends AbstractMapper implements PopulatorMapperInterface
{
    protected $trackPrototype = null;

    public function __construct(Track $trackPrototype)
    {
        $this->trackPrototype = $trackPrototype;
    }

    /**
     * @see PopulatorMapperInterface::map()
     */
    public function map(\DOMDocument $dom)
    {
        $track = clone $this->trackPrototype;
        $track->setId($this->getDomVal($dom, 'id'));
        $track->setProductIdMain($this->getDomVal($dom, 'productIdMain'));
        $track->setSongId($this->getDomVal($dom, 'songId'));
        $track->setCountry($this->getDomVal($dom, 'country'));
        $track->setArtworkTrack1($this->getDomVal($dom, 'artworkTrack1'));
        $track->setVersion($this->getDomVal($dom, 'version'));
        $track->setIsrc($this->getDomVal($dom, 'isrc'));
        $track->setPYear($this->getDomVal($dom, 'pYear'));
        $track->setPLine($this->getDomVal($dom, 'pLine'));
        $track->setDigitalRightType($this->getDomVal($dom, 'digitalRightType'));
        $track->setArtist($this->getDomVal($dom, 'artist'));
        $track->setPlaytime($this->getDomVal($dom, 'playtime'));
        $track->setTitle($this->getDomVal($dom, 'title'));
        $track->setType($this->getDomVal($dom, 'type'));
        $track->setExplicitFlag($this->getDomVal($dom, 'explicitFlag'));
        return $track;
    }
}