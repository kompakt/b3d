<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Dom\Label;

use Kompakt\B3d\Details\Entity\Label;
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

    protected function buildDom(Label $label)
    {
        $dom = new \DOMDocument("1.0", "utf-8");
        $root = $dom->createElement('label');
        $root->appendChild($dom->createElement('id', htmlspecialchars($label->getId())));
        $root->appendChild($dom->createElement('name', htmlspecialchars($label->getName())));
        $root->appendChild($dom->createElement('code', htmlspecialchars($label->getCode())));
        $root->appendChild($dom->createElement('infoEnglish', htmlspecialchars($label->getInfoEnglish())));
        $root->appendChild($dom->createElement('infoSecond', htmlspecialchars($label->getInfoSecond())));
        $root->appendChild($dom->createElement('url1', htmlspecialchars($label->getUrl1())));
        $root->appendChild($dom->createElement('url2', htmlspecialchars($label->getUrl2())));
        $root->appendChild($dom->createElement('artwork1', htmlspecialchars($label->getArtwork1())));
        $root->appendChild($dom->createElement('artwork2', htmlspecialchars($label->getArtwork2())));
        $root->appendChild($dom->createElement('defaultCLine', htmlspecialchars($label->getDefaultCLine())));
        $root->appendChild($dom->createElement('defaultPLine', htmlspecialchars($label->getDefaultPLine())));
        $root->appendChild($dom->createElement('isrcBase', htmlspecialchars($label->getIsrcBase())));
        $root->appendChild($dom->createElement('territoryId', htmlspecialchars($label->getTerritoryId())));
        $root->appendChild($dom->createElement('notes', htmlspecialchars($label->getNotes())));
        $dom->appendChild($root);
        return $dom;
    }
}