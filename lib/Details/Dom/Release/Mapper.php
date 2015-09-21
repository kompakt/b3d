<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Dom\Release;

use Kompakt\B3d\Details\Entity\Release;
use Kompakt\B3d\Util\Dom\AbstractMapper;
use Kompakt\B3d\Details\Populator\MapperInterface as PopulatorMapperInterface;

class Mapper extends AbstractMapper implements PopulatorMapperInterface
{
    protected $releasePrototype = null;

    public function __construct(Release $releasePrototype)
    {
        $this->releasePrototype = $releasePrototype;
    }

    /**
     * @see PopulatorMapperInterface::map()
     */
    public function map(\DOMDocument $dom)
    {
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
            $release->setReleaseDate($this->toDate($releaseDate));
        }

        $release->setType($this->getDomVal($dom, 'type'));
        $release->setNotes($this->getDomVal($dom, 'notes'));
        $release->setLabelId($this->getDomVal($dom, 'id'));
        return $release;
    }
}