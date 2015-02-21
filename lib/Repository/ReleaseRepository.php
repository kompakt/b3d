<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Repository;

use Kompakt\B3d\Entity\Release;

class ReleaseRepository
{
    protected $releases = null;

    public function add(Release $release)
    {
        $this->releases[$release->getId()] = $release;
    }

    public function getById($id)
    {
        return (array_key_exists($id, $this->releases)) ? $this->releases[$id] : null;
    }

    public function getAll()
    {
        return $this->releases;
    }
}