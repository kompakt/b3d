<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\Track;

use Kompakt\B3d\Details\Endpoint\Resource\BaseMapper;
use Kompakt\B3d\Details\Entity\Track;
use Kompakt\B3d\Details\Populator\DataMapperInterface;

class Mapper extends BaseMapper implements DataMapperInterface
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
        $track->setUuid($this->trim($data['UUID']));
        $track->setArtist($this->trim($data['artist']));
        $track->setArtworkTrack1($this->trim($data['artwork_track1']));
        $track->setCountry($this->trim($data['country']));
        $track->setDigitalRightType($this->trim($data['digital_right_type']));
        $track->setExplicitFlag($this->trim($data['explicit_flag']));
        $track->setIsrc($this->trim($data['isrc']));
        $track->setLanguage($this->trim($data['language']));
        $track->setPLine($this->trim($data['p_line']));
        $track->setPYear($this->trim($data['p_year']));
        $track->setPlaytime($this->trim($data['playtime']));
        $track->setProductIdMain($this->trim($data['product_id_main']));
        $track->setSongId($this->trim($data['song_id']));
        $track->setTitle($this->trim($data['title']));
        $track->setId($this->trim($data['track_id']));
        $track->setType($this->trim($data['type']));
        $track->setVersion($this->trim($data['version']));
        return $track;
    }
}