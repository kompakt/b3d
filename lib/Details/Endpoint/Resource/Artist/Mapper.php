<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\Artist;

use Kompakt\B3d\Details\Endpoint\Resource\BaseMapper;
use Kompakt\B3d\Details\Entity\Artist;
use Kompakt\B3d\Details\Populator\DataMapperInterface;

class Mapper extends BaseMapper implements DataMapperInterface
{
    protected $artistPrototype = null;

    public function __construct(Artist $artistPrototype)
    {
        $this->artistPrototype = $artistPrototype;
    }

    /**
     * @see DataMapperInterface::map()
     */
    public function map(array $data)
    {
        $artist = clone $this->artistPrototype;
        $artist->setName($this->trim($data['artist_name']));
        $artist->setMechanicalId($this->trim($data['mechanical_id']));
        $artist->setBioEngl($this->trim($data['bio_engl']));
        $artist->setBioOwn($this->trim($data['bio_own']));
        $artist->setNotes($this->trim($data['notes']));
        $artist->setArtwork1($this->trim($data['artwork1']));
        $artist->setArtwork2($this->trim($data['artwork2']));
        $artist->setUrl1($this->trim($data['url1']));
        $artist->setUrl2($this->trim($data['url2']));
        $artist->setLabelArtistId($this->trim($data['label_artist_id']));
        $artist->setSortName($this->trim($data['sort_name']));
        $artist->setAmgId($this->trim($data['amg_id']));
        return $artist;
    }
}