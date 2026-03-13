<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\ProductTrack;

use Kompakt\B3d\Details\Endpoint\Resource\BaseMapper;
use Kompakt\B3d\Details\Entity\ProductTrack;
use Kompakt\B3d\Details\Populator\DataMapperInterface;

class Mapper extends BaseMapper implements DataMapperInterface
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
        $productTrack->setSeqNo($this->trim($data['seq_no']));
        $productTrack->setSetNo($this->trim($data['set_no']));
        $productTrack->setProductTrackId($this->trim($data['product_track_id']));
        $productTrack->setBonusTrackFlag($this->trim($data['bonus_track_flag']));
        $productTrack->setTrackId($this->trim($data['track_id']));
        $productTrack->setProductId($this->trim($data['product_id']));
        $productTrack->setSide($this->trim($data['side']));
        $productTrack->setProductIsrc($this->trim($data['product_isrc']));
        $productTrack->setPlaytime($this->trim($data['playtime']));
        return $productTrack;
    }
}