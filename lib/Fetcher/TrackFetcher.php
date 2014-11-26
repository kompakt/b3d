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
            $track->setId($item['track_id']);
            $track->setTitle($item['title']);
            $track->setProductIdMain($item['product_id_main']);
            $track->setSongId($item['song_id']);
            $track->setCountry($item['country']);
            $track->setArtworkTrack1($item['artwork_track1']);
            $track->setVersion($item['version']);
            $track->setIsrc($item['isrc']);
            $track->setPYear($item['p_year']);
            $track->setPLine($item['p_line']);
            $track->setDigitalRightType($item['digital_right_type']);
            $track->setArtist($item['artist']);
            $track->setPlaytime($item['playtime']);
            $track->setType($item['type']);
            $track->setExplicitFlag($item['explicit_flag']);
            $tracks[] = $track;
        }

        return $tracks;
    }
}