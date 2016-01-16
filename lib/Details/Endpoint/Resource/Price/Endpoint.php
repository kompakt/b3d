<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\Price;

use GuzzleHttp\Client;
use Kompakt\B3d\Details\Endpoint\Resource\Exception\UnexpectedValueException;
use Kompakt\B3d\Details\Endpoint\Cache\EndpointInterface;

class Endpoint implements EndpointInterface
{
    protected $client = null;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @see EndpointInterface::fetchAll()
     */
    public function fetchAll()
    {
        try {
            $response = $this->client->get('action=prices');
            $data = json_decode($response->getBody(), true);

            $success
                = (array_key_exists('success', $data))
                ? $data['success']
                : 0
            ;

            if (!$success)
            {
                $error
                    = (array_key_exists('error', $data))
                    ? $data['error']
                    : 0
                ;

                throw new UnexpectedValueException($error);
            }

            return
                (array_key_exists('prices', $data))
                ? $data['prices']
                : array()
            ;
        }
        catch (\Exception $e)
        {
            throw new UnexpectedValueException(
                sprintf('Error fetching prices: "%s"', $e->getMessage())
            );
        }
    }
}