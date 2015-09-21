<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Repository;

use Kompakt\B3d\Details\Entity\Artist;
use Kompakt\B3d\Details\Populator\RepositoryInterface;

class ArtistRepository implements RepositoryInterface
{
    protected $labelArtistIds = array();

    /**
     * @see RepositoryInterface::add()
     */
    public function add($artist)
    {
        $this->addArtist($artist);
    }

    public function getByLabelArtistId($id)
    {
        return
            (array_key_exists($id, $this->labelArtistIds))
            ? $this->labelArtistIds[$id]
            : null
        ;
    }

    public function getAll()
    {
        return $this->labelArtistIds;
    }

    protected function addArtist(Artist $artist)
    {
        $this->labelArtistIds[$artist->getLabelArtistId()] = $artist;
    }
}