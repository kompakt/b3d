<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Dom\Product;

use Kompakt\B3d\Details\Entity\Product;
use Kompakt\B3d\Details\Endpoint\Cache\DomBuilderInterface;

class Builder implements DomBuilderInterface
{
    /**
     * @see DomBuilderInterface::build()
     */
    public function build($entity)
    {
        return $this->buildDom($entity);
    }

    protected function buildDom(Product $product)
    {
        $dom = new \DOMDocument("1.0", "utf-8");
        $root = $dom->createElement('product');
        $root->appendChild($dom->createElement('id', htmlspecialchars($product->getId())));
        $root->appendChild($dom->createElement('catalogNumber', htmlspecialchars($product->getCatalogNumber())));
        $root->appendChild($dom->createElement('streamYesNo', htmlspecialchars($product->getStreamYesNo())));
        $root->appendChild($dom->createElement('identifier', htmlspecialchars($product->getIdentifier())));
        $root->appendChild($dom->createElement('digitalPhysical', htmlspecialchars($product->getDigitalPhysical())));
        $root->appendChild($dom->createElement('supplierId', htmlspecialchars($product->getSupplierId())));
        $root->appendChild($dom->createElement('weight', htmlspecialchars($product->getWeight())));
        $root->appendChild($dom->createElement('releaseShift', htmlspecialchars($product->getReleaseShift())));
        $root->appendChild($dom->createElement('infoEnglish', htmlspecialchars($product->getInfoEnglish())));
        $root->appendChild($dom->createElement('infoSecond', htmlspecialchars($product->getInfoSecond())));
        $root->appendChild($dom->createElement('releaseId', htmlspecialchars($product->getReleaseId())));
        $root->appendChild($dom->createElement('downloadYesNo', htmlspecialchars($product->getDownloadYesNo())));
        $root->appendChild($dom->createElement('deliveryNow', htmlspecialchars($product->getDeliveryNow())));

        /*if ($product->getDeliveryConfirmedDate())
        {
            $root->appendChild($dom->createElement('releaseDate', htmlspecialchars($product->getDeliveryConfirmedDate()->format('Y-m-d'))));
        }*/

        $root->appendChild($dom->createElement('deliveryConfirmedDate', htmlspecialchars($product->getDeliveryConfirmedDate())));
        $root->appendChild($dom->createElement('barcode', htmlspecialchars($product->getBarcode())));
        $root->appendChild($dom->createElement('deliveredFlag', htmlspecialchars($product->getDeliveredFlag())));

        /*if ($product->getDeliveredDate())
        {
            $root->appendChild($dom->createElement('releaseDate', htmlspecialchars($product->getDeliveredDate()->format('Y-m-d'))));
        }*/

        $root->appendChild($dom->createElement('deliveredDate', htmlspecialchars($product->getDeliveredDate())));
        $root->appendChild($dom->createElement('deliveryConfirmedFlag', htmlspecialchars($product->getDeliveryConfirmedFlag())));
        $root->appendChild($dom->createElement('attribute1', htmlspecialchars($product->getAttribute1())));
        $root->appendChild($dom->createElement('attribute2', htmlspecialchars($product->getAttribute2())));
        $root->appendChild($dom->createElement('attribute3', htmlspecialchars($product->getAttribute3())));
        $root->appendChild($dom->createElement('formatId', htmlspecialchars($product->getFormatId())));
        $root->appendChild($dom->createElement('artworkProduct1', htmlspecialchars($product->getArtworkProduct1())));
        $root->appendChild($dom->createElement('artworkProduct2', htmlspecialchars($product->getArtworkProduct2())));
        $root->appendChild($dom->createElement('priceCodeId', htmlspecialchars($product->getPriceCodeId())));
        $root->appendChild($dom->createElement('language', htmlspecialchars($product->getLanguage())));
        $root->appendChild($dom->createElement('ppd', htmlspecialchars($product->getPpd())));
        $root->appendChild($dom->createElement('version', htmlspecialchars($product->getVersion())));
        $root->appendChild($dom->createElement('costPrice', htmlspecialchars($product->getCostPrice())));
        $root->appendChild($dom->createElement('notes', htmlspecialchars($product->getNotes())));
        $root->appendChild($dom->createElement('typeId', htmlspecialchars($product->getTypeId())));
        $dom->appendChild($root);
        return $dom;
    }
}