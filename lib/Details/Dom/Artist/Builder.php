<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Dom\Artist;

use Kompakt\B3d\Details\Entity\Artist;
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

    protected function buildDom(Artist $artist)
    {
        $dom = new \DOMDocument("1.0", "utf-8");
        $root = $dom->createElement('artist');
        $root->appendChild($dom->createElement('name', htmlspecialchars($artist->getName())));
        $root->appendChild($dom->createElement('mechanicalId', htmlspecialchars($artist->getMechanicalId())));
        $root->appendChild($dom->createElement('bioEngl', htmlspecialchars($artist->getBioEngl())));
        $root->appendChild($dom->createElement('bioOwn', htmlspecialchars($artist->getBioOwn())));
        $root->appendChild($dom->createElement('notes', htmlspecialchars($artist->getNotes())));
        $root->appendChild($dom->createElement('artwork1', htmlspecialchars($artist->getArtwork1())));
        $root->appendChild($dom->createElement('artwork2', htmlspecialchars($artist->getArtwork2())));
        $root->appendChild($dom->createElement('url1', htmlspecialchars($artist->getUrl1())));
        $root->appendChild($dom->createElement('url2', htmlspecialchars($artist->getUrl2())));
        $root->appendChild($dom->createElement('labelArtistId', htmlspecialchars($artist->getLabelArtistId())));
        $root->appendChild($dom->createElement('sortName', htmlspecialchars($artist->getSortName())));
        $root->appendChild($dom->createElement('amgId', htmlspecialchars($artist->getAmgId())));
        $dom->appendChild($root);
        return $dom;
    }
}