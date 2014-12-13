<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Fetcher;

use GuzzleHttp\Client;
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
        $response = $this->client->get('action=products');
        $data = $response->json();

        if (!array_key_exists('products', $data))
        {
            return array();
        }

        $products = array();

        foreach ($data['products'] as $item)
        {
            $product = clone $this->productPrototype;
            $product->setId($item['product_id']);
            $product->setCatalogNumber($item['catalog_no']);
            $product->setStreamYesNo($item['stream_yes_no']);
            $product->setDigitalPhysical($item['digital_physical']);
            $product->setSupplierId($item['supplier_id']);
            $product->setWeight($item['weight']);
            $product->setReleaseShift($item['release_shift']);
            $product->setInfoEnglish($item['product_info_english']);
            $product->setInfoSecond($item['product_info_second']);
            $product->setId($item['release_id']);
            $product->setDownloadYesNo($item['download_yes_no']);
            $product->setDeliveryConfirmedDate($item['delivery_confirmed_date']);
            $product->setBarcode($item['barcode']);
            $product->setDeliveredDate($item['delivered_date']);
            $product->setDeliveryConfirmedFlag($item['delivery_confirmed_flag']);
            $product->setAttribute1($item['attribute1']);
            $product->setAttribute2($item['attribute2']);
            $product->setAttribute3($item['attribute3']);
            $product->setFormatId($item['format_id']);
            $product->setDeliveredFlag($item['delivered_flag']);
            $product->setArtworkProduct1($item['artwork_product1']);
            $product->setArtworkProduct2($item['artwork_product2']);
            $product->setPriceCodeId($item['price_code_id']);
            $product->setLanguage($item['language']);
            $product->setPpd($item['ppd']);
            $product->setVersion($item['version']);
            $product->setCostPrice($item['cost_price']);
            $product->setDeliveryNow($item['delivery_now']);
            $product->setNotes($item['notes']);
            $product->setTypeId($item['product_type_id']);
            $products[] = $product;
        }

        return $products;
    }
}