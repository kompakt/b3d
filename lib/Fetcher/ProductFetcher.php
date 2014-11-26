<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Fetcher;

use Guzzle\Http\Client;
use Kompakt\B3d\Entity\Product;

class ProductFetcher
{
    protected $client = null;
    protected $productPrototype = null;

    public function __construct(
        Client $client,
        Product $productPrototype
    )
    {
        $this->client = $client;
        $this->productPrototype = $productPrototype;
    }

    public function fetchAll()
    {
        $request = $this->client->get('action=products');
        $response = $request->send();
        $data = $response->json();

        if (!array_key_exists('products', $data))
        {
            return array();
        }

        $products = array();

        foreach ($data['products'] as $item)
        {
            $product = clone $this->productPrototype;
            $product->setCatalogNumber($item['catalog_no']);
            $products[] = $product;
        }

        return $products;
    }
}