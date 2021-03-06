<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\ProductTrack;

use GuzzleHttp\Client;
use Kompakt\B3d\Details\Endpoint\Resource\Exception\UnexpectedValueException;
use Kompakt\B3d\Details\Populator\Endpoint\EndpointInterface;

class Endpoint implements EndpointInterface
{
    protected $client = null;
    protected $baseUrl = null;
    protected $apiKey = null;

    public function __construct(Client $client, $baseUrl, $apiKey)
    {
        $this->client = $client;
        $this->baseUrl = $baseUrl;
        $this->apiKey = $apiKey;
    }

    /**
     * @see EndpointInterface::fetchAll()
     */
    public function fetchAll()
    {
        try {
            $queryParams = [
                'api_key' => $this->apiKey,
                'action' => 'productTracks'
            ];

            $params = [
                'query' => $queryParams
            ];

            $response = $this->client->request('GET', $this->baseUrl, $params);
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
                (array_key_exists('product_tracks', $data))
                ? $data['product_tracks']
                : array()
            ;
        }
        catch (\Exception $e)
        {
            throw new UnexpectedValueException(
                sprintf('Error fetching product-tracks: "%s"', $e->getMessage())
            );
        }
    }
}