<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\Order;

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

    public function transmit(array $orderData, array $itemData)
    {
        $baseMessage = 'Order could not be sent to Details.';

        try {
            $baseParams = [
                'api_key' => $this->apiKey,
                'action' => 'addOrder'
            ];

            $baseParams = array_merge($baseParams, $orderData);
            $qs = http_build_query($baseParams);

            foreach ($itemData as $row)
            {
                $qs .= sprintf('&orderLines=%s', implode('|', $row));
            }

            $url = sprintf("%s?%s", $this->baseUrl, $qs);
            $response = $this->client->request('GET', $url);
        }
        catch (\Exception $e)
        {
            throw new UnexpectedValueException($e->getMessage(), 0, $e);
        }

        if ($response->getStatusCode() !== 200)
        {
            throw new UnexpectedValueException(
                sprintf(
                    '%s Received status code %d',
                    $baseMessage,
                    $response->getStatusCode()
                )
            );
        }

        $data = json_decode($response->getBody(), true);

        $success
            = (array_key_exists('success', $data))
            ? $data['success']
            : 0
        ;

        if (!$success)
        {
            throw new UnexpectedValueException(
                sprintf(
                    '%s Received answer said: %s',
                    $baseMessage,
                    $response->getBody()
                )
            );
        }

        return true;
    }
}