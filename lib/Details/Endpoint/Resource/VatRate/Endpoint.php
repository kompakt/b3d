<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\VatRate;

use GuzzleHttp\Client;
use Kompakt\B3d\Details\Endpoint\Resource\Exception\UnexpectedValueException;

class Endpoint
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

    public function fetchAll(\DateTime $startingDate)
    {
        try {
            $queryParams = [
                'api_key' => $this->apiKey,
                'output_format' => 'json',
                'action' => 'custom_sql',
                'custom_sql_id' => 405,
                '1' => $startingDate->format('Y-m-d')
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
                (array_key_exists('rows', $data))
                ? $data['rows']
                : array()
            ;
        }
        catch (\Exception $e)
        {
            throw new UnexpectedValueException(
                sprintf('Error fetching vat rates: "%s"', $e->getMessage())
            );
        }
    }
}