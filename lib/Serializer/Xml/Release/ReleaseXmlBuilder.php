<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Serializer\Xml\Release;

use Kompakt\B3d\Entity\Release;

class ReleaseXmlBuilder
{
    public function build(Release $release)
    {
        $dom = new \DOMDocument("1.0", "utf-8");
        $root = $dom->createElement('release');
        $root->appendChild($dom->createElement('status', htmlspecialchars($release->getStatus())));
        $root->appendChild($dom->createElement('title', htmlspecialchars($release->getTitle())));
        $root->appendChild($dom->createElement('titleAlt', htmlspecialchars($release->getTitleAlt())));
        $root->appendChild($dom->createElement('infoEnglish', htmlspecialchars($release->getInfoEnglish())));
        $root->appendChild($dom->createElement('infoSecond', htmlspecialchars($release->getInfoSecond())));
        $root->appendChild($dom->createElement('identifier', htmlspecialchars($release->getIdentifier())));
        $root->appendChild($dom->createElement('artist', htmlspecialchars($release->getArtist())));
        $root->appendChild($dom->createElement('artwork1', htmlspecialchars($release->getArtwork1())));
        $root->appendChild($dom->createElement('artwork2', htmlspecialchars($release->getArtwork2())));
        $root->appendChild($dom->createElement('projectId', htmlspecialchars($release->getProjectId())));
        $root->appendChild($dom->createElement('id', htmlspecialchars($release->getId())));

        if ($release->getReleaseDate())
        {
            $root->appendChild($dom->createElement('releaseDate', htmlspecialchars($release->getReleaseDate()->format('Y-m-d'))));
        }

        $root->appendChild($dom->createElement('type', htmlspecialchars($release->getType())));
        $root->appendChild($dom->createElement('notes', htmlspecialchars($release->getNotes())));
        $root->appendChild($dom->createElement('labelId', htmlspecialchars($release->getLabelId())));
        $dom->appendChild($root);
        return $dom;
    }
}