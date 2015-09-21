<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Dom\ProductTrack;

use Kompakt\B3d\Details\Entity\ProductTrack;
use Kompakt\B3d\Details\Endpoint\Cache\DomBuilderInterface;

class Builder implements DomBuilderInterface
{
    /**
     * @see DomBuilderInterface::build()
     */
    public function build($entity)
    {
        return $this->buildDom($entity);
    }

    protected function buildDom(ProductTrack $productTrack)
    {
        $dom = new \DOMDocument("1.0", "utf-8");
        $root = $dom->createElement('productTrack');
        $root->appendChild($dom->createElement('seqNo', htmlspecialchars($productTrack->getSeqNo())));
        $root->appendChild($dom->createElement('setNo', htmlspecialchars($productTrack->getSetNo())));
        $root->appendChild($dom->createElement('productTrackId', htmlspecialchars($productTrack->getProductTrackId())));
        $root->appendChild($dom->createElement('bonusTrackFlag', htmlspecialchars($productTrack->getBonusTrackFlag())));
        $root->appendChild($dom->createElement('trackId', htmlspecialchars($productTrack->getTrackId())));
        $root->appendChild($dom->createElement('productId', htmlspecialchars($productTrack->getProductId())));
        $root->appendChild($dom->createElement('side', htmlspecialchars($productTrack->getSide())));
        $root->appendChild($dom->createElement('productIsrc', htmlspecialchars($productTrack->getProductIsrc())));
        $root->appendChild($dom->createElement('playtime', htmlspecialchars($productTrack->getPlaytime())));
        $dom->appendChild($root);
        return $dom;
    }
}