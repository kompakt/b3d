<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\Release;

use Kompakt\B3d\Details\Endpoint\Resource\BaseMapper;
use Kompakt\B3d\Details\Entity\Release;
use Kompakt\B3d\Details\Populator\DataMapperInterface;

class Mapper extends BaseMapper implements DataMapperInterface
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
        $release->setUuid($this->trim($data['UUID']));
        $release->setArtwork1($this->trim($data['artwork1']));
        $release->setArtwork2($this->trim($data['artwork2']));
        $release->setIdentifier($this->trim($data['identifier']));
        $release->setLabelId($this->trim($data['label_id']));
        $release->setNotes($this->trim($data['notes']));
        $release->setProjectId($this->trim($data['project_id']));
        $release->setReleaseArtist($this->trim($data['release_artist']));

        if ($data['release_date'])
        {
            $release->setReleaseDate(new \DateTime($this->trim($data['release_date'])));
        }

        $release->setReleaseId($this->trim($data['release_id']));
        $release->setReleaseInfoEnglish($this->trim($data['release_info_english']));
        $release->setReleaseInfoSecond($this->trim($data['release_info_second']));
        $release->setReleaseTitle($this->trim($data['release_title']));
        $release->setReleaseTitleAlt($this->trim($data['release_title_alt']));
        $release->setReleasetype($this->trim($data['release_type']));
        $release->setStatus($this->trim($data['status']));
        return $release;
    }
}