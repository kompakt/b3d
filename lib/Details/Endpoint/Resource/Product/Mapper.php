<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\Product;

use Kompakt\B3d\Details\Endpoint\Resource\BaseMapper;
use Kompakt\B3d\Details\Entity\Product;
use Kompakt\B3d\Details\Populator\DataMapperInterface;

class Mapper extends BaseMapper implements DataMapperInterface
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
        $product->setUuid($this->trim($data['UUID']));
        $product->setAlbumSingleMerch($this->trim($data['album_single_merch']));
        $product->setAltArtist($this->trim($data['alt_artist']));
        $product->setAltTitle($this->trim($data['alt_title']));

        if ($data['product_date'])
        {
            $product->setProductDate(new \DateTime($this->trim($data['product_date'])));
        }

        $product->setArtworkProduct1($this->trim($data['artwork_product1']));
        $product->setArtworkProduct2($this->trim($data['artwork_product2']));
        $product->setAttribute1($this->trim($data['attribute1']));
        $product->setAttribute2($this->trim($data['attribute2']));
        $product->setAttribute3($this->trim($data['attribute3']));
        $product->setBarcode($this->trim($data['barcode']));
        $product->setCatalogNumber($this->trim($data['catalog_no']));
        $product->setChannel($this->trim($data['channel']));
        $product->setCostPrice($this->trim($data['cost_price']));
        $product->setDefaultWeight($this->trim($data['default_weight']));
        $product->setDeliveredDate($this->trim($data['delivered_date']));
        $product->setDeliveredFlag($this->trim($data['delivered_flag']));
        $product->setDeliveryConfirmedDate($this->trim($data['delivery_confirmed_date']));
        $product->setDeliveryConfirmedFlag($this->trim($data['delivery_confirmed_flag']));
        $product->setDeliveryNow($this->trim($data['delivery_now']));
        $product->setDigitalPhysical($this->trim($data['digital_physical']));
        $product->setDownloadYesNo($this->trim($data['download_yes_no']));
        $product->setFormatId($this->trim($data['format_id']));
        $product->setFormatName($this->trim($data['format_name']));
        $product->setGroups($this->trim($data['price_code_groups']));
        $product->setHeadline($this->trim($data['headline']));
        $product->setIdentifier($this->trim($data['identifier']));
        $product->setInternalFlag($this->trim($data['internal_flag']));
        $product->setLanguage($this->trim($data['language']));
        $product->setMinMargin($this->trim($data['min_margin']));
        $product->setNotes($this->trim($data['notes']));
        $product->setPpd($this->trim($data['ppd']));
        $product->setPriceCodeDescription($this->trim($data['price_code_description']));
        $product->setPriceCodeId($this->trim($data['price_code_id']));
        $product->setPriceCodeName($this->trim($data['price_code_name']));
        $product->setProductId($this->trim($data['product_id']));
        $product->setProductInfoEnglish($this->trim($data['product_info_english']));
        $product->setProductInfoSecond($this->trim($data['product_info_second']));
        $product->setProductTypeId($this->trim($data['product_type_id']));
        $product->setProductTypeName($this->trim($data['product_type_name']));
        $product->setProductTypeId2($this->trim($data['product_type_id2']));
        $product->setProductTypeName2($this->trim($data['product_type_name2']));
        $product->setProformaPrice($this->trim($data['proforma_price']));
        $product->setReleaseId($this->trim($data['release_id']));
        $product->setReleaseShift($this->trim($data['release_shift']));
        $product->setStreamYesNo($this->trim($data['stream_yes_no']));
        $product->setSupplierId($this->trim($data['supplier_id']));
        $product->setTwoSidesFlag($this->trim($data['two_sides_flag']));
        $product->setVatType($this->trim($data['vat_type']));
        $product->setVersion($this->trim($data['version']));
        $product->setWeight($this->trim($data['weight']));
        return $product;
    }
}