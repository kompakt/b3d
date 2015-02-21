<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Serializer\Xml\Release;

use Kompakt\B3d\Entity\Release;
use Kompakt\B3d\Serializer\Xml\Release\Exception\DomainException;
use Kompakt\B3d\Serializer\Xml\Release\Exception\InvalidArgumentException;

class ReleaseXmlParser
{
    protected $releasePrototype = null;

    public function __construct(Release $releasePrototype)
    {
        $this->releasePrototype = $releasePrototype;
    }

    public function parse($xml)
    {
        set_error_handler(function($errno, $errstr, $errfile = null, $errline = null, array $errcontext = null)
        {
            throw new InvalidArgumentException($errstr);
        });

        $dom = new \DOMDocument();
        $dom->loadXml($xml);
        restore_error_handler();

        $toDate = function($date)
        {
            return \DateTime::createFromFormat('Y-m-d', $date);
        };

        $release = clone $this->releasePrototype;
        $release->setStatus($this->getDomVal($dom, 'status'));
        $release->setTitle($this->getDomVal($dom, 'title'));
        $release->setTitleAlt($this->getDomVal($dom, 'titleAlt'));
        $release->setInfoEnglish($this->getDomVal($dom, 'infoEnglish'));
        $release->setInfoSecond($this->getDomVal($dom, 'infoSecond'));
        $release->setIdentifier($this->getDomVal($dom, 'identifier'));
        $release->setArtist($this->getDomVal($dom, 'artist'));
        $release->setArtwork1($this->getDomVal($dom, 'artwork1'));
        $release->setArtwork2($this->getDomVal($dom, 'artwork2'));
        $release->setProjectId($this->getDomVal($dom, 'projectId'));
        $release->setId($this->getDomVal($dom, 'id'));

        $releaseDate = $this->getDomVal($dom, 'releaseDate');

        if ($releaseDate)
        {
            $release->setReleaseDate($toDate($releaseDate));
        }

        $release->setType($this->getDomVal($dom, 'type'));
        $release->setNotes($this->getDomVal($dom, 'notes'));
        $release->setLabelId($this->getDomVal($dom, 'id'));
        return $release;
    }

    protected function getDomVal($dom, $name)
    {
        $element = $dom->getElementsByTagName($name)->item(0);

        if (!$element)
        {
            throw new DomainException(sprintf('Xml element missing: "%s"', $name));
        }

        return $element->nodeValue;
    }
}