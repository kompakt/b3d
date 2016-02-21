<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\Stock;

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

    public function fetch(array $uuids, array $accountIds = [])
    {
        if (!count($uuids))
        {
            throw new UnexpectedValueException(sprintf(
                "Please provide some UUIDs for which stock levels should be fetched"
            ));
        }

        if (count($uuids) > 200)
        {
            throw new UnexpectedValueException(sprintf(
                "The API is limited to a maximum of 200 UUIDs per request: actual %s",
                count($uuids)
            ));
        }

        try {
            $url = $this->makeUrl($uuids, $accountIds);
            $response = $this->client->request('GET', $url);
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
                (array_key_exists('stocks', $data))
                ? $data['stocks']
                : array()
            ;
        }
        catch (\Exception $e)
        {
            throw new UnexpectedValueException(
                sprintf('Error fetching stocks: "%s"', $e->getMessage())
            );
        }
    }

    protected function makeUrl(array $uuids, array $accountIds = [])
    {
        $params = [
            'api_key' => $this->apiKey,
            'action' => 'stocks'
        ];

        if (count($uuids))
        {
            $params['product_uuids'] = implode('|', $uuids);
        }

        if (count($accountIds))
        {
            $params['account_ids'] = implode('|', $accountIds);
        }

        $qs = http_build_query($params);
        return sprintf("%s?%s", $this->baseUrl, $qs);
    }
}