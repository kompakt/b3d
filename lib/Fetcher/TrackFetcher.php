<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Fetcher;

use Guzzle\Http\Client;
use Kompakt\B3d\Entity\Track;

class TrackFetcher
{
    protected $client = null;
    protected $trackPrototype = null;

    public function __construct(
        Client $client,
        Track $trackPrototype
    )
    {
        $this->client = $client;
        $this->trackPrototype = $trackPrototype;
    }

    public function fetchAll()
    {
        $request = $this->client->get('action=tracks');
        $response = $request->send();
        $data = $response->json();

        if (!array_key_exists('tracks', $data))
        {
            return array();
        }

        $tracks = array();

        foreach ($data['tracks'] as $item)
        {
            $track = clone $this->trackPrototype;
            $track->setTitle($item['title']);
            $tracks[] = $track;
        }

        return $tracks;
    }
}