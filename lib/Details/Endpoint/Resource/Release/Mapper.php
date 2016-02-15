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
        $release->setUuid(trim($data['UUID']));
        $release->setArtwork1(trim($data['artwork1']));
        $release->setArtwork2(trim($data['artwork2']));
        $release->setIdentifier(trim($data['identifier']));
        $release->setLabelId(trim($data['label_id']));
        $release->setNotes(trim($data['notes']));
        $release->setProjectId(trim($data['project_id']));
        $release->setReleaseArtist(trim($data['release_artist']));

        if ($data['release_date'])
        {
            $release->setReleaseDate(new \DateTime(trim($data['release_date'])));
        }

        $release->setReleaseId(trim($data['release_id']));
        $release->setReleaseInfoEnglish(trim($data['release_info_english']));
        $release->setReleaseInfoSecond(trim($data['release_info_second']));
        $release->setReleaseTitle(trim($data['release_title']));
        $release->setReleaseTitleAlt(trim($data['release_title_alt']));
        $release->setReleasetype(trim($data['release_type']));
        $release->setStatus(trim($data['status']));
        return $release;
    }
}