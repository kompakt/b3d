<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Fetcher;

use Guzzle\Http\Client;
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
        $request = $this->client->get('action=artists');
        $response = $request->send();
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
            $artists[] = $artist;
        }

        return $artists;
    }
}