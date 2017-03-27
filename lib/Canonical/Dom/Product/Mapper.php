<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Canonical\Dom\Product;

use Kompakt\B3d\Canonical\Entity\Price;
use Kompakt\B3d\Canonical\Entity\Product;
use Kompakt\B3d\Canonical\Entity\Track;
use Kompakt\B3d\Util\Dom\AbstractMapper;

class Mapper extends AbstractMapper
{
    protected $productPrototype = null;
    protected $trackPrototype = null;
    protected $pricePrototype = null;

    public function __construct(
        Product $productPrototype,
        Track $trackPrototype,
        Price $pricePrototype
    )
    {
        $this->productPrototype = $productPrototype;
        $this->trackPrototype = $trackPrototype;
        $this->pricePrototype = $pricePrototype;
    }

    public function map(\DOMDocument $dom)
    {
        $product = clone $this->productPrototype;

        // label-fields
        $product->setLabel($this->getDomVal($dom, 'label'));

        // release-fields
        $product->setReleaseUuid($this->getDomVal($dom, 'releaseUuid'));
        $product->setReleaseArtwork1($this->getDomVal($dom, 'releaseArtwork1'));
        $product->setReleaseArtwork2($this->getDomVal($dom, 'releaseArtwork2'));
        $product->setReleaseIdentifier($this->getDomVal($dom, 'releaseIdentifier'));
        $product->setReleaseLabelId($this->getDomVal($dom, 'releaseLabelId'));
        $product->setReleaseNotes($this->getDomVal($dom, 'releaseNotes'));
        $product->setReleaseProjectId($this->getDomVal($dom, 'releaseProjectId'));
        $product->setReleaseArtist($this->getDomVal($dom, 'releaseArtist'));

        $releaseDate = $this->toDate($this->getDomVal($dom, 'releaseDate'));

        if ($releaseDate)
        {
            $product->setReleaseDate($releaseDate);
        }

        $product->setReleaseId($this->getDomVal($dom, 'releaseId'));
        $product->setReleaseInfoEnglish($this->getDomVal($dom, 'releaseInfoEnglish'));
        $product->setReleaseInfoSecond($this->getDomVal($dom, 'releaseInfoSecond'));
        $product->setReleaseTitle($this->getDomVal($dom, 'releaseTitle'));
        $product->setReleaseTitleAlt($this->getDomVal($dom, 'releaseTitleAlt'));
        $product->setReleaseType($this->getDomVal($dom, 'releaseType'));
        $product->setReleaseStatus($this->getDomVal($dom, 'releaseStatus'));

        // product-fields
        $product->setUuid($this->getDomVal($dom, 'uuid'));
        $product->setAlbumSingleMerch($this->getDomVal($dom, 'albumSingleMerch'));
        $product->setArtworkProduct1($this->getDomVal($dom, 'artworkProduct1'));
        $product->setArtworkProduct2($this->getDomVal($dom, 'artworkProduct2'));
        $product->setAttribute1($this->getDomVal($dom, 'attribute1'));
        $product->setAttribute2($this->getDomVal($dom, 'attribute2'));
        $product->setAttribute3($this->getDomVal($dom, 'attribute3'));
        $product->setBarcode($this->getDomVal($dom, 'barcode'));
        $product->setCatalogNumber($this->getDomVal($dom, 'catalogNumber'));
        $product->setChannel($this->getDomVal($dom, 'channel'));
        $product->setCostPrice($this->getDomVal($dom, 'costPrice'));
        $product->setDefaultWeight($this->getDomVal($dom, 'defaultWeight'));

        $deliveredDate = $this->toDate($this->getDomVal($dom, 'deliveredDate'));

        if ($deliveredDate)
        {
            $product->setDeliveredDate($deliveredDate);
        }

        $product->setDeliveredFlag($this->getDomVal($dom, 'deliveredFlag'));

        $deliveryConfirmedDate = $this->toDate($this->getDomVal($dom, 'deliveryConfirmedDate'));

        if ($deliveryConfirmedDate)
        {
            $product->setDeliveryConfirmedDate($deliveryConfirmedDate);
        }

        $product->setDeliveryConfirmedFlag($this->getDomVal($dom, 'deliveryConfirmedFlag'));
        $product->setDeliveryNow($this->getDomVal($dom, 'deliveryNow'));
        $product->setDigitalPhysical($this->getDomVal($dom, 'digitalPhysical'));
        $product->setDownloadYesNo($this->getDomVal($dom, 'downloadYesNo'));
        $product->setFormatId($this->getDomVal($dom, 'formatId'));
        $product->setFormatName($this->getDomVal($dom, 'formatName'));
        $product->setGroups($this->getDomVal($dom, 'groups'));
        $product->setHeadline($this->getDomVal($dom, 'headline'));
        $product->setIdentifier($this->getDomVal($dom, 'identifier'));
        $product->setInternalFlag($this->getDomVal($dom, 'internalFlag'));
        $product->setLanguage($this->getDomVal($dom, 'language'));
        $product->setMinMargin($this->getDomVal($dom, 'minMargin'));
        $product->setNotes($this->getDomVal($dom, 'notes'));
        $product->setPpd($this->getDomVal($dom, 'ppd'));
        $product->setPriceCodeDescription($this->getDomVal($dom, 'priceCodeDescription'));
        $product->setPriceCodeId($this->getDomVal($dom, 'priceCodeId'));
        $product->setPriceCodeName($this->getDomVal($dom, 'priceCodeName'));
        $product->setProductId($this->getDomVal($dom, 'productId'));
        $product->setProductInfoEnglish($this->getDomVal($dom, 'productInfoEnglish'));
        $product->setProductInfoSecond($this->getDomVal($dom, 'productInfoSecond'));
        $product->setProductTypeId($this->getDomVal($dom, 'productTypeId'));
        $product->setProductTypeName($this->getDomVal($dom, 'productTypeName'));
        $product->setProductTypeId2($this->getDomVal($dom, 'productTypeId2'));
        $product->setProductTypeName2($this->getDomVal($dom, 'productTypeName2'));
        $product->setProformaPrice($this->getDomVal($dom, 'proformaPrice'));
        $product->setReleaseId($this->getDomVal($dom, 'releaseId'));
        $product->setReleaseShift($this->getDomVal($dom, 'releaseShift'));
        $product->setStreamYesNo($this->getDomVal($dom, 'streamYesNo'));
        $product->setSupplierId($this->getDomVal($dom, 'supplierId'));
        $product->setTwoSidesFlag($this->getDomVal($dom, 'twoSidesFlag'));
        $product->setVatType($this->getDomVal($dom, 'vatType'));
        $product->setVersion($this->getDomVal($dom, 'version'));
        $product->setWeight($this->getDomVal($dom, 'weight'));

        $tracks = $this->getDomElement($dom, 'tracks');

        foreach ($tracks->getElementsByTagName('track') as $t)
        {
            $track = clone $this->trackPrototype;

            // product-track-fields
            $track->setSeqNo($this->getDomVal($t, 'seqNo'));
            $track->setSetNo($this->getDomVal($t, 'setNo'));
            #$track->setProductTrackId($this->getDomVal($t, 'productTrackId'));
            $track->setBonusTrackFlag($this->getDomVal($t, 'bonusTrackFlag'));
            #$track->setTrackId($this->getDomVal($t, 'trackId'));
            #$track->setProductId($this->getDomVal($t, 'productId'));
            $track->setSide($this->getDomVal($t, 'side'));
            $track->setProductIsrc($this->getDomVal($t, 'productIsrc'));
            $track->setPlaytime($this->getDomVal($t, 'playtime'));

            // track-fields
            $track->setUuid($this->getDomVal($t, 'uuid'));
            $track->setArtist($this->getDomVal($t, 'artist'));
            $track->setArtworkTrack1($this->getDomVal($t, 'artworkTrack1'));
            $track->setCountry($this->getDomVal($t, 'country'));
            $track->setDigitalRightType($this->getDomVal($t, 'digitalRightType'));
            $track->setExplicitFlag($this->getDomVal($t, 'explicitFlag'));
            $track->setIsrc($this->getDomVal($t, 'isrc'));
            $track->setLanguage($this->getDomVal($t, 'language'));
            $track->setPLine($this->getDomVal($t, 'pLine'));
            $track->setPYear($this->getDomVal($t, 'pYear'));
            $track->setPlaytime($this->getDomVal($t, 'playtime'));
            $track->setProductIdMain($this->getDomVal($t, 'productIdMain'));
            $track->setSongId($this->getDomVal($t, 'songId'));
            $track->setTitle($this->getDomVal($t, 'title'));
            $track->setId($this->getDomVal($t, 'id'));
            $track->setType($this->getDomVal($t, 'type'));
            $track->setVersion($this->getDomVal($t, 'version'));
            $product->addTrack($track);
        }

        $prices = $this->getDomElement($dom, 'prices');

        foreach ($prices->getElementsByTagName('priceItem') as $p)
        {
            $price = clone $this->pricePrototype;
            $price->setCurrencyId($this->getDomVal($p, 'currencyId'));
            $price->setCurrencyIso($this->getDomVal($p, 'currencyIso'));
            $price->setExternalTable($this->getDomVal($p, 'externalTable'));
            $price->setPayback($this->getDomVal($p, 'payback'));
            $price->setPrice($this->getDomVal($p, 'price'));
            $price->setPricelistId($this->getDomVal($p, 'pricelistId'));
            $price->setPricelistName($this->getDomVal($p, 'pricelistName'));
            $price->setProductId($this->getDomVal($p, 'productId'));
            $price->setProductPriceId($this->getDomVal($p, 'productPriceId'));
            $product->addPrice($price);
        }

        return $product;
    }
}