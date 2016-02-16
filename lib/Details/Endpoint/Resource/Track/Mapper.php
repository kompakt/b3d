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
        $track->setUuid(trim($data['UUID']));
        $track->setArtist(trim($data['artist']));
        $track->setArtworkTrack1(trim($data['artwork_track1']));
        $track->setCountry(trim($data['country']));
        $track->setDigitalRightType(trim($data['digital_right_type']));
        $track->setExplicitFlag(trim($data['explicit_flag']));
        $track->setIsrc(trim($data['isrc']));
        $track->setLanguage(trim($data['language']));
        $track->setPLine(trim($data['p_line']));
        $track->setPYear(trim($data['p_year']));
        $track->setPlaytime(trim($data['playtime']));
        $track->setProductIdMain(trim($data['product_id_main']));
        $track->setSongId(trim($data['song_id']));
        $track->setTitle(trim($data['title']));
        $track->setId(trim($data['track_id']));
        $track->setType(trim($data['type']));
        $track->setVersion(trim($data['version']));
        return $track;
    }
}