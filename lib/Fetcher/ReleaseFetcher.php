<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Fetcher;

use GuzzleHttp\Client;
use Kompakt\B3d\Entity\Release;

class ReleaseFetcher
{
    protected $client = null;
    protected $releasePrototype = null;

    public function __construct(
        Client $client,
        Release $releasePrototype
    )
    {
        $this->client = $client;
        $this->releasePrototype = $releasePrototype;
    }

    public function fetchAll()
    {
        $response = $this->client->get('action=releases');
        $data = $response->json();

        if (!array_key_exists('releases', $data))
        {
            return array();
        }

        $releases = array();

        foreach ($data['releases'] as $item)
        {
            $release = clone $this->releasePrototype;
            $release->setStatus($item['status']);
            $release->setTitle($item['release_title']);
            $release->setTitleAlt($item['release_title_alt']);
            $release->setInfoEnglish($item['release_info_english']);
            $release->setInfoSecond($item['release_info_second']);
            $release->setIdentifier($item['identifier']);
            $release->setArtist($item['release_artist']);
            $release->setArtwork1($item['artwork1']);
            $release->setArtwork2($item['artwork2']);
            $release->setProjectId($item['project_id']);
            $release->setId($item['release_id']);
            $release->setReleaseDate(new \DateTime($item['release_date']));
            $release->settype($item['release_type']);
            $release->setNotes($item['notes']);
            $release->setLabelId($item['label_id']);
            $releases[] = $release;
        }

        return $releases;
    }
}