<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Fetcher;

use Guzzle\Http\Client;
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
        $request = $this->client->get('action=releases');
        $response = $request->send();
        $data = $response->json();

        if (!array_key_exists('releases', $data))
        {
            return array();
        }

        $releases = array();

        foreach ($data['releases'] as $item)
        {
            $release = clone $this->releasePrototype;
            $release->setTitle($item['release_title']);
            $releases[] = $release;
        }

        return $releases;
    }
}