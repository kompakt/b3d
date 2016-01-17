<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\Artist;

use Kompakt\B3d\Details\Entity\Artist;
use Kompakt\B3d\Details\Populator\DataMapperInterface;

class Mapper implements DataMapperInterface
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
        $artist->setName(trim($data['artist_name']));
        $artist->setMechanicalId(trim($data['mechanical_id']));
        $artist->setBioEngl(trim($data['bio_engl']));
        $artist->setBioOwn(trim($data['bio_own']));
        $artist->setNotes(trim($data['notes']));
        $artist->setArtwork1(trim($data['artwork1']));
        $artist->setArtwork2(trim($data['artwork2']));
        $artist->setUrl1(trim($data['url1']));
        $artist->setUrl2(trim($data['url2']));
        $artist->setLabelArtistId(trim($data['label_artist_id']));
        $artist->setSortName(trim($data['sort_name']));
        $artist->setAmgId(trim($data['amg_id']));
        return $artist;
    }
}