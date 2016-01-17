<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\Release;

use Kompakt\B3d\Details\Entity\Release;
use Kompakt\B3d\Details\Populator\DataMapperInterface;

class Mapper implements DataMapperInterface
{
    protected $releasePrototype = null;

    public function __construct(Release $releasePrototype)
    {
        $this->releasePrototype = $releasePrototype;
    }

    /**
     * @see DataMapperInterface::map()
     */
    public function map(array $data)
    {
        $release = clone $this->releasePrototype;
        $release->setStatus(trim($data['status']));
        $release->setTitle(trim($data['release_title']));
        $release->setTitleAlt(trim($data['release_title_alt']));
        $release->setInfoEnglish(trim($data['release_info_english']));
        $release->setInfoSecond(trim($data['release_info_second']));
        $release->setIdentifier(trim($data['identifier']));
        $release->setArtist(trim($data['release_artist']));
        $release->setArtwork1(trim($data['artwork1']));
        $release->setArtwork2(trim($data['artwork2']));
        $release->setProjectId(trim($data['project_id']));
        $release->setId(trim($data['release_id']));
        $release->setReleaseDate(new \DateTime(trim($data['release_date'])));
        $release->settype(trim($data['release_type']));
        $release->setNotes(trim($data['notes']));
        $release->setLabelId(trim($data['label_id']));
        return $release;
    }
}