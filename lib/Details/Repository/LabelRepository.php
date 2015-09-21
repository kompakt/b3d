<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Repository;

use Kompakt\B3d\Details\Entity\Label;
use Kompakt\B3d\Details\Populator\RepositoryInterface;

class LabelRepository implements RepositoryInterface
{
    protected $ids = array();

    /**
     * @see RepositoryInterface::add()
     */
    public function add($label)
    {
        $this->addLabel($label);
    }

    public function getById($id)
    {
        return
            (array_key_exists($id, $this->ids))
            ? $this->ids[$id]
            : null
        ;
    }

    public function getAll()
    {
        return $this->ids;
    }

    protected function addLabel(Label $label)
    {
        $this->ids[$label->getId()] = $label;
    }
}