<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Cache;

use Kompakt\B3d\Details\Endpoint\Cache\EndpointInterface;
use Kompakt\B3d\Details\Endpoint\Cache\SerializerInterface;

class Runner
{
    protected $resources = array();

    public function add(
        EndpointInterface $endpoint,
        SerializerInterface $serializer
    )
    {
        $this->resources[] = array(
            'endpoint' => $endpoint,
            'serializer' => $serializer
        );
    }

    public function run()
    {
        foreach ($this->resources as $resource)
        {
            $resource['serializer']->serialize($resource['endpoint']->fetchAll());
        }
    }
}