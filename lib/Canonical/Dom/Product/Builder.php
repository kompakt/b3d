<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Canonical\Dom\Product;

use Kompakt\B3d\Canonical\Entity\Product;

class Builder
{
    public function build($entity)
    {
        return $this->buildDom($entity);
    }

    protected function buildDom(Product $product)
    {
        $dom = new \DOMDocument("1.0", "utf-8");
        $root = $dom->createElement('product');

        // label-fields
        $root->appendChild($dom->createElement('label', $this->html($product->getLabel())));

        // release-fields
        $root->appendChild($dom->createElement('releaseUuid', $this->html($product->getReleaseUuid())));
        $root->appendChild($dom->createElement('releaseArtwork1', $this->html($product->getReleaseArtwork1())));
        $root->appendChild($dom->createElement('releaseArtwork2', $this->html($product->getReleaseArtwork2())));
        $root->appendChild($dom->createElement('releaseIdentifier', $this->html($product->getReleaseIdentifier())));
        $root->appendChild($dom->createElement('releaseLabelId', $this->html($product->getReleaseLabelId())));
        $root->appendChild($dom->createElement('releaseNotes', $this->html($product->getReleaseNotes())));
        $root->appendChild($dom->createElement('releaseProjectId', $this->html($product->getReleaseProjectId())));
        $root->appendChild($dom->createElement('releaseArtist', $this->html($product->getReleaseArtist())));

        $releaseDate
            = ($product->getReleaseDate())
            ? htmlspecialchars($product->getReleaseDate()->format('Y-m-d'))
            : ''
        ;

        $root->appendChild($dom->createElement('releaseDate', $releaseDate));
        $root->appendChild($dom->createElement('releaseId', $this->html($product->getReleaseId())));
        $root->appendChild($dom->createElement('releaseInfoEnglish', $this->html($product->getReleaseInfoEnglish())));
        $root->appendChild($dom->createElement('releaseInfoSecond', $this->html($product->getReleaseInfoSecond())));
        $root->appendChild($dom->createElement('releaseTitle', $this->html($product->getReleaseTitle())));
        $root->appendChild($dom->createElement('releaseTitleAlt', $this->html($product->getReleaseTitleAlt())));
        $root->appendChild($dom->createElement('releaseType', $this->html($product->getReleaseType())));
        $root->appendChild($dom->createElement('releaseStatus', $this->html($product->getReleaseStatus())));

        // product-fields
        $root->appendChild($dom->createElement('uuid', $this->html($product->getUuid())));
        $root->appendChild($dom->createElement('altArtist', $this->html($product->getAltArtist())));
        $root->appendChild($dom->createElement('altTitle', $this->html($product->getAltTitle())));

        $productDate
            = ($product->getProductDate())
            ? htmlspecialchars($product->getProductDate()->format('Y-m-d'))
            : ''
        ;

        $root->appendChild($dom->createElement('productDate', $productDate));
        $root->appendChild($dom->createElement('albumSingleMerch', $this->html($product->getAlbumSingleMerch())));
        $root->appendChild($dom->createElement('artworkProduct1', $this->html($product->getArtworkProduct1())));
        $root->appendChild($dom->createElement('artworkProduct2', $this->html($product->getArtworkProduct2())));
        $root->appendChild($dom->createElement('attribute1', $this->html($product->getAttribute1())));
        $root->appendChild($dom->createElement('attribute2', $this->html($product->getAttribute2())));
        $root->appendChild($dom->createElement('attribute3', $this->html($product->getAttribute3())));
        $root->appendChild($dom->createElement('barcode', $this->html($product->getBarcode())));
        $root->appendChild($dom->createElement('catalogNumber', $this->html($product->getCatalogNumber())));
        $root->appendChild($dom->createElement('channel', $this->html($product->getChannel())));
        $root->appendChild($dom->createElement('costPrice', $this->html($product->getCostPrice())));
        $root->appendChild($dom->createElement('defaultWeight', $this->html($product->getDefaultWeight())));
        
        $deliveredDate
            = ($product->getDeliveredDate())
            ? htmlspecialchars($product->getDeliveredDate()->format('Y-m-d'))
            : ''
        ;

        $root->appendChild($dom->createElement('deliveredDate', $deliveredDate));
        $root->appendChild($dom->createElement('deliveredFlag', $this->html($product->getDeliveredFlag())));

        $deliveryConfirmedDate
            = ($product->getDeliveryConfirmedDate())
            ? htmlspecialchars($product->getDeliveryConfirmedDate()->format('Y-m-d'))
            : ''
        ;

        $root->appendChild($dom->createElement('deliveryConfirmedDate', $deliveryConfirmedDate));
        $root->appendChild($dom->createElement('deliveryConfirmedFlag', $this->html($product->getDeliveryConfirmedFlag())));
        $root->appendChild($dom->createElement('deliveryNow', $this->html($product->getDeliveryNow())));
        $root->appendChild($dom->createElement('digitalPhysical', $this->html($product->getDigitalPhysical())));
        $root->appendChild($dom->createElement('downloadYesNo', $this->html($product->getDownloadYesNo())));
        $root->appendChild($dom->createElement('formatId', $this->html($product->getFormatId())));
        $root->appendChild($dom->createElement('formatName', $this->html($product->getFormatName())));
        $root->appendChild($dom->createElement('groups', $this->html($product->getGroups())));
        $root->appendChild($dom->createElement('headline', $this->html($product->getHeadline())));
        $root->appendChild($dom->createElement('identifier', $this->html($product->getIdentifier())));
        $root->appendChild($dom->createElement('internalFlag', $this->html($product->getInternalFlag())));
        $root->appendChild($dom->createElement('language', $this->html($product->getLanguage())));
        $root->appendChild($dom->createElement('minMargin', $this->html($product->getMinMargin())));
        $root->appendChild($dom->createElement('notes', $this->html($product->getNotes())));
        $root->appendChild($dom->createElement('ppd', $this->html($product->getPpd())));
        $root->appendChild($dom->createElement('priceCodeDescription', $this->html($product->getPriceCodeDescription())));
        $root->appendChild($dom->createElement('priceCodeId', $this->html($product->getPriceCodeId())));
        $root->appendChild($dom->createElement('priceCodeName', $this->html($product->getPriceCodeName())));
        $root->appendChild($dom->createElement('productId', $this->html($product->getProductId())));
        $root->appendChild($dom->createElement('productInfoEnglish', $this->html($product->getProductInfoEnglish())));
        $root->appendChild($dom->createElement('productInfoSecond', $this->html($product->getProductInfoSecond())));
        $root->appendChild($dom->createElement('productTypeId', $this->html($product->getProductTypeId())));
        $root->appendChild($dom->createElement('productTypeName', $this->html($product->getProductTypeName())));
        $root->appendChild($dom->createElement('productTypeId2', $this->html($product->getProductTypeId2())));
        $root->appendChild($dom->createElement('productTypeName2', $this->html($product->getProductTypeName2())));
        $root->appendChild($dom->createElement('proformaPrice', $this->html($product->getProformaPrice())));
        $root->appendChild($dom->createElement('releaseId', $this->html($product->getReleaseId())));
        $root->appendChild($dom->createElement('releaseShift', $this->html($product->getReleaseShift())));
        $root->appendChild($dom->createElement('streamYesNo', $this->html($product->getStreamYesNo())));
        $root->appendChild($dom->createElement('supplierId', $this->html($product->getSupplierId())));
        $root->appendChild($dom->createElement('twoSidesFlag', $this->html($product->getTwoSidesFlag())));
        $root->appendChild($dom->createElement('vatType', $this->html($product->getVatType())));
        $root->appendChild($dom->createElement('version', $this->html($product->getVersion())));
        $root->appendChild($dom->createElement('weight', $this->html($product->getWeight())));

        $tracks = $dom->createElement('tracks');
        $root->appendChild($tracks);

        foreach ($product->getTracks() as $t)
        {
            $track = $dom->createElement('track');

            // product-track fields
            $track->appendChild($dom->createElement('seqNo', $this->html($t->getSeqNo())));
            $track->appendChild($dom->createElement('setNo', $this->html($t->getSetNo())));
            $track->appendChild($dom->createElement('bonusTrackFlag', $this->html($t->getBonusTrackFlag())));
            $track->appendChild($dom->createElement('side', $this->html($t->getSide())));
            $track->appendChild($dom->createElement('productIsrc', $this->html($t->getProductIsrc())));

            // track-fields
            $track->appendChild($dom->createElement('uuid', $this->html($t->getUuid())));
            $track->appendChild($dom->createElement('artist', $this->html($t->getArtist())));
            $track->appendChild($dom->createElement('artworkTrack1', $this->html($t->getArtworkTrack1())));
            $track->appendChild($dom->createElement('country', $this->html($t->getCountry())));
            $track->appendChild($dom->createElement('digitalRightType', $this->html($t->getDigitalRightType())));
            $track->appendChild($dom->createElement('explicitFlag', $this->html($t->getExplicitFlag())));
            $track->appendChild($dom->createElement('isrc', $this->html($t->getIsrc())));
            $track->appendChild($dom->createElement('language', $this->html($t->getLanguage())));
            $track->appendChild($dom->createElement('pLine', $this->html($t->getPLine())));
            $track->appendChild($dom->createElement('pYear', $this->html($t->getPYear())));
            $track->appendChild($dom->createElement('playtime', $this->html($t->getPlaytime())));
            $track->appendChild($dom->createElement('productIdMain', $this->html($t->getProductIdMain())));
            $track->appendChild($dom->createElement('songId', $this->html($t->getSongId())));
            $track->appendChild($dom->createElement('title', $this->html($t->getTitle())));
            $track->appendChild($dom->createElement('id', $this->html($t->getId())));
            $track->appendChild($dom->createElement('type', $this->html($t->getType())));
            $track->appendChild($dom->createElement('version', $this->html($t->getVersion())));
            $tracks->appendChild($track);
        }

        $prices = $dom->createElement('prices');
        $root->appendChild($prices);

        foreach ($product->getPrices() as $p)
        {
            $price = $dom->createElement('priceItem');
            $price->appendChild($dom->createElement('currencyId', $this->html($p->getCurrencyId())));
            $price->appendChild($dom->createElement('currencyIso', $this->html($p->getCurrencyIso())));
            $price->appendChild($dom->createElement('externalTable', $this->html($p->getExternalTable())));
            $price->appendChild($dom->createElement('payback', $this->html($p->getPayback())));
            $price->appendChild($dom->createElement('price', $this->html($p->getPrice())));
            $price->appendChild($dom->createElement('pricelistId', $this->html($p->getPricelistId())));
            $price->appendChild($dom->createElement('pricelistName', $this->html($p->getPricelistName())));
            $price->appendChild($dom->createElement('productId', $this->html($p->getProductId())));
            $price->appendChild($dom->createElement('productPriceId', $this->html($p->getProductPriceId())));
            $prices->appendChild($price);
        }

        $dom->appendChild($root);
        return $dom;
    }

    protected function html($v): string
    {
        return htmlspecialchars($v ?: '');
    }
}