<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\Track;

use Kompakt\B3d\Details\Entity\Track;
use Kompakt\B3d\Details\Populator\DataMapperInterface;

class Mapper implements DataMapperInterface
{
    protected $trackPrototype = null;

    public function __construct(Track $trackPrototype)
    {
        $this->trackPrototype = $trackPrototype;
    }

    /**
     * @see DataMapperInterface::map()
     */
    public function map(array $data)
    {
        $track = clone $this->trackPrototype;
        $track->setId(trim($data['track_id']));
        $track->setTitle(trim($data['title']));
        $track->setProductIdMain(trim($data['product_id_main']));
        $track->setSongId(trim($data['song_id']));
        $track->setCountry(trim($data['country']));
        $track->setArtworkTrack1(trim($data['artwork_track1']));
        $track->setVersion(trim($data['version']));
        $track->setIsrc(trim($data['isrc']));
        $track->setPYear(trim($data['p_year']));
        $track->setPLine(trim($data['p_line']));
        $track->setDigitalRightType(trim($data['digital_right_type']));
        $track->setArtist(trim($data['artist']));
        $track->setPlaytime(trim($data['playtime']));
        $track->setType(trim($data['type']));
        $track->setExplicitFlag(trim($data['explicit_flag']));
        return $track;
    }
}