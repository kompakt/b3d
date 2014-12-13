<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Fetcher;

use GuzzleHttp\Client;
use Kompakt\B3d\Entity\Label;

class LabelFetcher
{
    protected $client = null;
    protected $labelPrototype = null;

    public function __construct(
        Client $client,
        Label $labelPrototype
    )
    {
        $this->client = $client;
        $this->labelPrototype = $labelPrototype;
    }

    public function fetchAll()
    {
        $response = $this->client->get('action=labels');
        $data = $response->json();

        if (!array_key_exists('labels', $data))
        {
            return array();
        }

        $labels = array();

        foreach ($data['labels'] as $item)
        {
            $label = clone $this->labelPrototype;
            $label->setId($item['label_id']);
            $label->setName($item['label_name']);
            $label->setCode($item['label_code']);
            $label->setInfoEnglish($item['label_info_english']);
            $label->setInfoSecond($item['label_info_second']);
            $label->setUrl1($item['url1']);
            $label->setUrl2($item['url2']);
            $label->setArtwork1($item['artwork1']);
            $label->setArtwork2($item['artwork2']);
            $label->setDefaultCLine($item['default_c_line']);
            $label->setDefaultPLine($item['default_p_line']);
            $label->setIsrcBase($item['isrc_base']);
            $label->setTerritoryId($item['territory_id']);
            $label->setNotes($item['notes']);
            $labels[] = $label;
        }

        return $labels;
    }
}