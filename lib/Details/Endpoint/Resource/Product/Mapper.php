<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\Product;

use Kompakt\B3d\Details\Entity\Product;
use Kompakt\B3d\Details\Endpoint\Cache\DataMapperInterface;

class Mapper implements DataMapperInterface
{
    protected $productPrototype = null;

    public function __construct(Product $productPrototype)
    {
        $this->productPrototype = $productPrototype;
    }

    /**
     * @see DataMapperInterface::map()
     */
    public function map(array $data)
    {
        $product = clone $this->productPrototype;
        $product->setId(trim($data['product_id']));
        $product->setCatalogNumber(trim($data['catalog_no']));
        $product->setStreamYesNo(trim($data['stream_yes_no']));
        $product->setDigitalPhysical(trim($data['digital_physical']));
        $product->setSupplierId(trim($data['supplier_id']));
        $product->setWeight(trim($data['weight']));
        $product->setReleaseShift(trim($data['release_shift']));
        $product->setInfoEnglish(trim($data['product_info_english']));
        $product->setInfoSecond(trim($data['product_info_second']));
        $product->setReleaseId(trim($data['release_id']));
        $product->setDownloadYesNo(trim($data['download_yes_no']));
        $product->setDeliveryNow(trim($data['delivery_now']));
        $product->setDeliveryConfirmedDate(trim($data['delivery_confirmed_date']));
        $product->setBarcode(trim($data['barcode']));
        $product->setDeliveredFlag(trim($data['delivered_flag']));
        $product->setDeliveredDate(trim($data['delivered_date']));
        $product->setDeliveryConfirmedFlag(trim($data['delivery_confirmed_flag']));
        $product->setAttribute1(trim($data['attribute1']));
        $product->setAttribute2(trim($data['attribute2']));
        $product->setAttribute3(trim($data['attribute3']));
        $product->setFormatId(trim($data['format_id']));
        $product->setArtworkProduct1(trim($data['artwork_product1']));
        $product->setArtworkProduct2(trim($data['artwork_product2']));
        $product->setPriceCodeId(trim($data['price_code_id']));
        $product->setLanguage(trim($data['language']));
        $product->setPpd(trim($data['ppd']));
        $product->setVersion(trim($data['version']));
        $product->setCostPrice(trim($data['cost_price']));
        $product->setDeliveryNow(trim($data['delivery_now']));
        $product->setNotes(trim($data['notes']));
        $product->setTypeId(trim($data['product_type_id']));
        return $product;
    }
}