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
        $root->appendChild($dom->createElement('label', htmlspecialchars($product->getLabel())));

        // release-fields
        $root->appendChild($dom->createElement('status', htmlspecialchars($product->getStatus())));
        $root->appendChild($dom->createElement('title', htmlspecialchars($product->getTitle())));
        $root->appendChild($dom->createElement('titleAlt', htmlspecialchars($product->getTitleAlt())));
        $root->appendChild($dom->createElement('infoEnglish', htmlspecialchars($product->getInfoEnglish())));
        $root->appendChild($dom->createElement('infoSecond', htmlspecialchars($product->getInfoSecond())));
        #$root->appendChild($dom->createElement('identifier', htmlspecialchars($product->getIdentifier())));
        $root->appendChild($dom->createElement('artist', htmlspecialchars($product->getArtist())));
        $root->appendChild($dom->createElement('artwork1', htmlspecialchars($product->getArtwork1())));
        $root->appendChild($dom->createElement('artwork2', htmlspecialchars($product->getArtwork2())));
        #$root->appendChild($dom->createElement('projectId', htmlspecialchars($product->getProjectId())));
        #$root->appendChild($dom->createElement('id', htmlspecialchars($product->getId())));

        if ($product->getReleaseDate())
        {
            $root->appendChild($dom->createElement('releaseDate', htmlspecialchars($product->getReleaseDate()->format('Y-m-d'))));
        }

        $root->appendChild($dom->createElement('type', htmlspecialchars($product->getType())));
        $root->appendChild($dom->createElement('notes', htmlspecialchars($product->getNotes())));
        #$root->appendChild($dom->createElement('labelId', htmlspecialchars($product->getLabelId())));

        // product-fields
        #$root->appendChild($dom->createElement('id', htmlspecialchars($product->getId())));
        $root->appendChild($dom->createElement('catalogNumber', htmlspecialchars($product->getCatalogNumber())));
        $root->appendChild($dom->createElement('streamYesNo', htmlspecialchars($product->getStreamYesNo())));
        #$root->appendChild($dom->createElement('identifier', htmlspecialchars($product->getIdentifier())));
        $root->appendChild($dom->createElement('digitalPhysical', htmlspecialchars($product->getDigitalPhysical())));
        #$root->appendChild($dom->createElement('supplierId', htmlspecialchars($product->getSupplierId())));
        $root->appendChild($dom->createElement('weight', htmlspecialchars($product->getWeight())));
        $root->appendChild($dom->createElement('releaseShift', htmlspecialchars($product->getReleaseShift())));
        #$root->appendChild($dom->createElement('infoEnglish', htmlspecialchars($product->getInfoEnglish())));
        #$root->appendChild($dom->createElement('infoSecond', htmlspecialchars($product->getInfoSecond())));
        #$root->appendChild($dom->createElement('releaseId', htmlspecialchars($product->getReleaseId())));
        $root->appendChild($dom->createElement('downloadYesNo', htmlspecialchars($product->getDownloadYesNo())));
        #$root->appendChild($dom->createElement('deliveryNow', htmlspecialchars($product->getDeliveryNow())));

        /*if ($product->getDeliveryConfirmedDate())
        {
            $root->appendChild($dom->createElement('releaseDate', htmlspecialchars($product->getDeliveryConfirmedDate()->format('Y-m-d'))));
        }*/

        #$root->appendChild($dom->createElement('deliveryConfirmedDate', htmlspecialchars($product->getDeliveryConfirmedDate())));
        $root->appendChild($dom->createElement('barcode', htmlspecialchars($product->getBarcode())));
        #$root->appendChild($dom->createElement('deliveredFlag', htmlspecialchars($product->getDeliveredFlag())));

        /*if ($product->getDeliveredDate())
        {
            $root->appendChild($dom->createElement('releaseDate', htmlspecialchars($product->getDeliveredDate()->format('Y-m-d'))));
        }*/

        #$root->appendChild($dom->createElement('deliveredDate', htmlspecialchars($product->getDeliveredDate())));
        #$root->appendChild($dom->createElement('deliveryConfirmedFlag', htmlspecialchars($product->getDeliveryConfirmedFlag())));
        $root->appendChild($dom->createElement('attribute1', htmlspecialchars($product->getAttribute1())));
        $root->appendChild($dom->createElement('attribute2', htmlspecialchars($product->getAttribute2())));
        $root->appendChild($dom->createElement('attribute3', htmlspecialchars($product->getAttribute3())));
        #$root->appendChild($dom->createElement('formatId', htmlspecialchars($product->getFormatId())));
        $root->appendChild($dom->createElement('artworkProduct1', htmlspecialchars($product->getArtworkProduct1())));
        $root->appendChild($dom->createElement('artworkProduct2', htmlspecialchars($product->getArtworkProduct2())));
        #$root->appendChild($dom->createElement('priceCodeId', htmlspecialchars($product->getPriceCodeId())));
        $root->appendChild($dom->createElement('language', htmlspecialchars($product->getLanguage())));
        $root->appendChild($dom->createElement('ppd', htmlspecialchars($product->getPpd())));
        $root->appendChild($dom->createElement('version', htmlspecialchars($product->getVersion())));
        $root->appendChild($dom->createElement('costPrice', htmlspecialchars($product->getCostPrice())));
        #$root->appendChild($dom->createElement('notes', htmlspecialchars($product->getNotes())));
        #$root->appendChild($dom->createElement('typeId', htmlspecialchars($product->getTypeId())));

        $tracks = $dom->createElement('tracks');
        $root->appendChild($tracks);

        foreach ($product->getTracks() as $t)
        {
            $track = $dom->createElement('track');

            // product-track fields
            $track->appendChild($dom->createElement('seqNo', htmlspecialchars($t->getSeqNo())));
            $track->appendChild($dom->createElement('setNo', htmlspecialchars($t->getSetNo())));
            $track->appendChild($dom->createElement('bonusTrackFlag', htmlspecialchars($t->getBonusTrackFlag())));
            $track->appendChild($dom->createElement('side', htmlspecialchars($t->getSide())));
            $track->appendChild($dom->createElement('productIsrc', htmlspecialchars($t->getProductIsrc())));

            // track-fields
            #$track->appendChild($dom->createElement('id', htmlspecialchars($t->getId())));
            #$track->appendChild($dom->createElement('productIdMain', htmlspecialchars($t->getProductIdMain())));
            #$track->appendChild($dom->createElement('songId', htmlspecialchars($t->getSongId())));
            $track->appendChild($dom->createElement('country', htmlspecialchars($t->getCountry())));
            $track->appendChild($dom->createElement('artworkTrack1', htmlspecialchars($t->getArtworkTrack1())));
            $track->appendChild($dom->createElement('version', htmlspecialchars($t->getVersion())));
            $track->appendChild($dom->createElement('isrc', htmlspecialchars($t->getIsrc())));
            $track->appendChild($dom->createElement('pYear', htmlspecialchars($t->getPYear())));
            $track->appendChild($dom->createElement('pLine', htmlspecialchars($t->getPLine())));
            $track->appendChild($dom->createElement('digitalRightType', htmlspecialchars($t->getDigitalRightType())));
            $track->appendChild($dom->createElement('artist', htmlspecialchars($t->getArtist())));
            $track->appendChild($dom->createElement('playtime', htmlspecialchars($t->getPlaytime())));
            $track->appendChild($dom->createElement('title', htmlspecialchars($t->getTitle())));
            $track->appendChild($dom->createElement('type', htmlspecialchars($t->getType())));
            $track->appendChild($dom->createElement('explicitFlag', htmlspecialchars($t->getExplicitFlag())));
            $tracks->appendChild($track);
        }

        $dom->appendChild($root);
        return $dom;
    }
}