<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Dom\Product;

use Kompakt\B3d\Details\Entity\Product;
use Kompakt\B3d\Util\Dom\AbstractMapper;
use Kompakt\B3d\Details\Populator\MapperInterface as PopulatorMapperInterface;

class Mapper extends AbstractMapper implements PopulatorMapperInterface
{
    protected $productPrototype = null;

    public function __construct(Product $productPrototype)
    {
        $this->productPrototype = $productPrototype;
    }

    /**
     * @see PopulatorMapperInterface::map()
     */
    public function map(\DOMDocument $dom)
    {
        $product = clone $this->productPrototype;
        $product->setId($this->getDomVal($dom, 'id'));
        $product->setCatalogNumber($this->getDomVal($dom, 'catalogNumber'));
        $product->setStreamYesNo($this->getDomVal($dom, 'streamYesNo'));
        $product->setIdentifier($this->getDomVal($dom, 'identifier'));
        $product->setDigitalPhysical($this->getDomVal($dom, 'digitalPhysical'));
        $product->setSupplierId($this->getDomVal($dom, 'supplierId'));
        $product->setWeight($this->getDomVal($dom, 'weight'));
        $product->setReleaseShift($this->getDomVal($dom, 'releaseShift'));
        $product->setInfoEnglish($this->getDomVal($dom, 'infoEnglish'));
        $product->setInfoSecond($this->getDomVal($dom, 'infoSecond'));
        $product->setReleaseId($this->getDomVal($dom, 'releaseId'));
        $product->setDownloadYesNo($this->getDomVal($dom, 'downloadYesNo'));
        $product->setDeliveryNow($this->getDomVal($dom, 'deliveryNow'));

        $deliveryConfirmedDate = $this->getDomVal($dom, 'deliveryConfirmedDate');

        if ($deliveryConfirmedDate)
        {
            $product->setDeliveryConfirmedDate($this->toDate($deliveryConfirmedDate));
        }

        $product->setBarcode($this->getDomVal($dom, 'barcode'));
        $product->setDeliveredFlag($this->getDomVal($dom, 'deliveredFlag'));

        $deliveredDate = $this->getDomVal($dom, 'deliveredDate');

        if ($deliveredDate)
        {
            $product->setDeliveredDate($this->toDate($deliveredDate));
        }

        $product->setDeliveryConfirmedFlag($this->getDomVal($dom, 'deliveryConfirmedFlag'));
        $product->setAttribute1($this->getDomVal($dom, 'attribute1'));
        $product->setAttribute2($this->getDomVal($dom, 'attribute2'));
        $product->setAttribute3($this->getDomVal($dom, 'attribute3'));
        $product->setFormatId($this->getDomVal($dom, 'formatId'));
        $product->setArtworkProduct1($this->getDomVal($dom, 'artworkProduct1'));
        $product->setArtworkProduct2($this->getDomVal($dom, 'artworkProduct2'));
        $product->setPriceCodeId($this->getDomVal($dom, 'priceCodeId'));
        $product->setLanguage($this->getDomVal($dom, 'language'));
        $product->setPpd($this->getDomVal($dom, 'ppd'));
        $product->setVersion($this->getDomVal($dom, 'version'));
        $product->setCostPrice($this->getDomVal($dom, 'costPrice'));
        $product->setNotes($this->getDomVal($dom, 'notes'));
        $product->setTypeId($this->getDomVal($dom, 'typeId'));
        return $product;
    }
}