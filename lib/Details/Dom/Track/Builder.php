<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Dom\Track;

use Kompakt\B3d\Details\Entity\Track;
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

    protected function buildDom(Track $track)
    {
        $dom = new \DOMDocument("1.0", "utf-8");
        $root = $dom->createElement('track');
        $root->appendChild($dom->createElement('id', htmlspecialchars($track->getId())));
        $root->appendChild($dom->createElement('productIdMain', htmlspecialchars($track->getProductIdMain())));
        $root->appendChild($dom->createElement('songId', htmlspecialchars($track->getSongId())));
        $root->appendChild($dom->createElement('country', htmlspecialchars($track->getCountry())));
        $root->appendChild($dom->createElement('artworkTrack1', htmlspecialchars($track->getArtworkTrack1())));
        $root->appendChild($dom->createElement('version', htmlspecialchars($track->getVersion())));
        $root->appendChild($dom->createElement('isrc', htmlspecialchars($track->getIsrc())));
        $root->appendChild($dom->createElement('pYear', htmlspecialchars($track->getPYear())));
        $root->appendChild($dom->createElement('pLine', htmlspecialchars($track->getPLine())));
        $root->appendChild($dom->createElement('digitalRightType', htmlspecialchars($track->getDigitalRightType())));
        $root->appendChild($dom->createElement('artist', htmlspecialchars($track->getArtist())));
        $root->appendChild($dom->createElement('playtime', htmlspecialchars($track->getPlaytime())));
        $root->appendChild($dom->createElement('title', htmlspecialchars($track->getTitle())));
        $root->appendChild($dom->createElement('type', htmlspecialchars($track->getType())));
        $root->appendChild($dom->createElement('explicitFlag', htmlspecialchars($track->getExplicitFlag())));
        $dom->appendChild($root);
        return $dom;
    }
}