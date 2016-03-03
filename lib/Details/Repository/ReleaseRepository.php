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

    public function getSlice($first, $max)
    {
        $first = (int) $first;
        $first = ($first < 0) ? 0 : $first;
        $max = (int) $max;
        $max = ($max < 0) ? 0 : $max;
        $releases = [];
        $i = -1;

        foreach ($this->releaseIds as $release)
        {
            $i++;

            if ($i < $first)
            {
                continue;
            }

            if ($i > $first + $max - 1)
            {
                break;
            }

            $releases[] = $release;
        }

        return $releases;
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