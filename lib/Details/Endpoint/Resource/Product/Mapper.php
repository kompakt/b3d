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
        $product->setUuid(trim($data['UUID']));
        $product->setAlbumSingleMerch(trim($data['album_single_merch']));
        $product->setArtworkProduct1(trim($data['artwork_product1']));
        $product->setArtworkProduct2(trim($data['artwork_product2']));
        $product->setAttribute1(trim($data['attribute1']));
        $product->setAttribute2(trim($data['attribute2']));
        $product->setAttribute3(trim($data['attribute3']));
        $product->setBarcode(trim($data['barcode']));
        $product->setCatalogNumber(trim($data['catalog_no']));
        $product->setChannel(trim($data['channel']));
        $product->setCostPrice(trim($data['cost_price']));
        $product->setDefaultWeight(trim($data['default_weight']));
        $product->setDeliveredDate(trim($data['delivered_date']));
        $product->setDeliveredFlag(trim($data['delivered_flag']));
        $product->setDeliveryConfirmedDate(trim($data['delivery_confirmed_date']));
        $product->setDeliveryConfirmedFlag(trim($data['delivery_confirmed_flag']));
        $product->setDeliveryNow(trim($data['delivery_now']));
        $product->setDigitalPhysical(trim($data['digital_physical']));
        $product->setDownloadYesNo(trim($data['download_yes_no']));
        $product->setFormatId(trim($data['format_id']));
        $product->setFormatName(trim($data['format_name']));
        $product->setGroups(trim($data['groups']));
        $product->setIdentifier(trim($data['identifier']));
        $product->setInternalFlag(trim($data['internal_flag']));
        $product->setLanguage(trim($data['language']));
        $product->setMinMargin(trim($data['min_margin']));
        $product->setNotes(trim($data['notes']));
        $product->setPpd(trim($data['ppd']));
        $product->setPriceCodeDescription(trim($data['price_code_description']));
        $product->setPriceCodeId(trim($data['price_code_id']));
        $product->setPriceCodeName(trim($data['price_code_name']));
        $product->setProductId(trim($data['product_id']));
        $product->setProductInfoEnglish(trim($data['product_info_english']));
        $product->setProductInfoSecond(trim($data['product_info_second']));
        $product->setProductTypeId(trim($data['product_type_id']));
        $product->setProductTypeName(trim($data['product_type_name']));
        $product->setProductTypeName2(trim($data['product_type_name2']));
        $product->setProformaPrice(trim($data['proforma_price']));
        $product->setReleaseId(trim($data['release_id']));
        $product->setReleaseShift(trim($data['release_shift']));
        $product->setStreamYesNo(trim($data['stream_yes_no']));
        $product->setSupplierId(trim($data['supplier_id']));
        $product->setTwoSidesFlag(trim($data['two_sides_flag']));
        $product->setVatType(trim($data['vat_type']));
        $product->setVersion(trim($data['version']));
        $product->setWeight(trim($data['weight']));
        return $product;
    }
}