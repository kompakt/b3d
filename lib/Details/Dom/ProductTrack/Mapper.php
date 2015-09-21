<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Dom\ProductTrack;

use Kompakt\B3d\Details\Entity\ProductTrack;
use Kompakt\B3d\Util\Dom\AbstractMapper;
use Kompakt\B3d\Details\Populator\MapperInterface as PopulatorMapperInterface;

class Mapper extends AbstractMapper implements PopulatorMapperInterface
{
    protected $productTrackPrototype = null;

    public function __construct(ProductTrack $productTrackPrototype)
    {
        $this->productTrackPrototype = $productTrackPrototype;
    }

    /**
     * @see PopulatorMapperInterface::map()
     */
    public function map(\DOMDocument $dom)
    {
        $productTrack = clone $this->productTrackPrototype;
        $productTrack->setSeqNo($this->getDomVal($dom, 'seqNo'));
        $productTrack->setSetNo($this->getDomVal($dom, 'setNo'));
        $productTrack->setProductTrackId($this->getDomVal($dom, 'productTrackId'));
        $productTrack->setBonusTrackFlag($this->getDomVal($dom, 'bonusTrackFlag'));
        $productTrack->setTrackId($this->getDomVal($dom, 'trackId'));
        $productTrack->setProductId($this->getDomVal($dom, 'productId'));
        $productTrack->setSide($this->getDomVal($dom, 'side'));
        $productTrack->setProductIsrc($this->getDomVal($dom, 'productIsrc'));
        $productTrack->setPlaytime($this->getDomVal($dom, 'playtime'));
        return $productTrack;
    }
}