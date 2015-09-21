<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Repository;

use Kompakt\B3d\Details\Entity\ProductTrack;
use Kompakt\B3d\Details\Populator\RepositoryInterface;

class ProductTrackRepository implements RepositoryInterface
{
    protected $ids = array();
    protected $productIds = array();

    /**
     * @see RepositoryInterface::add()
     */
    public function add($productTrack)
    {
        $this->addProductTrack($productTrack);
    }

    public function getAllByProductId($id)
    {
        return
            (array_key_exists($id, $this->productIds))
            ? $this->productIds[$id]
            : array()
        ;
    }

    public function getAll()
    {
        return $this->ids;
    }

    protected function addProductTrack(ProductTrack $productTrack)
    {
        $this->ids[$productTrack->getProductTrackId()] = $productTrack;

        if (!array_key_exists($productTrack->getProductId(), $this->productIds))
        {
            $this->productIds[$productTrack->getProductId()] = array();
        }

        $this->productIds[$productTrack->getProductId()][] = $productTrack;
    }
}