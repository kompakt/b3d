<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\ProductTrack;

use Kompakt\B3d\Details\Entity\ProductTrack;
use Kompakt\B3d\Details\Populator\DataMapperInterface;

class Mapper implements DataMapperInterface
{
    protected $productTrackPrototype = null;

    public function __construct(ProductTrack $productTrackPrototype)
    {
        $this->productTrackPrototype = $productTrackPrototype;
    }

    /**
     * @see DataMapperInterface::map()
     */
    public function map(array $data)
    {
        $productTrack = clone $this->productTrackPrototype;
        $productTrack->setSeqNo(trim($data['seq_no']));
        $productTrack->setSetNo(trim($data['set_no']));
        $productTrack->setProductTrackId(trim($data['product_track_id']));
        $productTrack->setBonusTrackFlag(trim($data['bonus_track_flag']));
        $productTrack->setTrackId(trim($data['track_id']));
        $productTrack->setProductId(trim($data['product_id']));
        $productTrack->setSide(trim($data['side']));
        $productTrack->setProductIsrc(trim($data['product_isrc']));
        $productTrack->setPlaytime(trim($data['playtime']));
        return $productTrack;
    }
}