<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Fetcher;

use Guzzle\Http\Client;
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
        $request = $this->client->get('action=labels');
        $response = $request->send();
        $data = $response->json();

        if (!array_key_exists('labels', $data))
        {
            return array();
        }

        $labels = array();

        foreach ($data['labels'] as $item)
        {
            $label = clone $this->labelPrototype;
            $label->setTitle($item['label_title']);
            $labels[] = $label;
        }

        return $labels;
    }
}