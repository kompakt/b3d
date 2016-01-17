<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Repository;

use Kompakt\B3d\Details\Entity\Release;
use Kompakt\B3d\Details\Populator\RepositoryInterface;

class ReleaseRepository implements RepositoryInterface
{
    protected $releaseIds = array();

    /**
     * @see RepositoryInterface::add()
     */
    public function add($release)
    {
        $this->addRelease($release);
    }

    public function getById($id)
    {
        return
            (array_key_exists($id, $this->releaseIds))
            ? $this->releaseIds[$id]
            : null
        ;
    }

    public function getAll()
    {
        return $this->releaseIds;
    }

    protected function addRelease(Release $release)
    {
        $this->releaseIds[$release->getReleaseId()] = $release;
    }
}