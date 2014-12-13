<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Fetcher;

use GuzzleHttp\Client;
use Kompakt\B3d\Entity\Artist;

class ArtistFetcher
{
    protected $client = null;
    protected $artistPrototype = null;

    public function __construct(
        Client $client,
        Artist $artistPrototype
    )
    {
        $this->client = $client;
        $this->artistPrototype = $artistPrototype;
    }

    public function fetchAll()
    {
        $response = $this->client->get('action=artists');
        $data = $response->json();

        if (!array_key_exists('artists', $data))
        {
            return array();
        }

        $artists = array();

        foreach ($data['artists'] as $item)
        {
            $artist = clone $this->artistPrototype;
            $artist->setName($item['artist_name']);
            $artist->setMechanicalId($item['mechanical_id']);
            $artist->setBioEngl($item['bio_engl']);
            $artist->setBioOwn($item['bio_own']);
            $artist->setNotes($item['notes']);
            $artist->setArtwork1($item['artwork1']);
            $artist->setArtwork2($item['artwork2']);
            $artist->setUrl1($item['url1']);
            $artist->setUrl2($item['url2']);
            $artist->setLabelArtistId($item['label_artist_id']);
            $artist->setSortName($item['sort_name']);
            $artist->setAmgId($item['amg_id']);
            $artists[] = $artist;
        }

        return $artists;
    }
}