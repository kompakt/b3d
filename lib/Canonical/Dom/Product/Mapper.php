<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Canonical\Dom\Product;

use Kompakt\B3d\Canonical\Entity\Product;
use Kompakt\B3d\Canonical\Entity\Track;
use Kompakt\B3d\Util\Dom\AbstractMapper;

class Mapper extends AbstractMapper
{
    protected $productPrototype = null;
    protected $trackPrototype = null;

    public function __construct(Product $productPrototype, Track $trackPrototype)
    {
        $this->productPrototype = $productPrototype;
        $this->trackPrototype = $trackPrototype;
    }

    public function map(\DOMDocument $dom)
    {
        $product = clone $this->productPrototype;

        // label-fields
        $product->setLabel($this->getDomVal($dom, 'label'));

        // release-fields
        $product->setStatus($this->getDomVal($dom, 'status'));
        $product->setTitle($this->getDomVal($dom, 'title'));
        $product->setTitleAlt($this->getDomVal($dom, 'titleAlt'));
        $product->setInfoEnglish($this->getDomVal($dom, 'infoEnglish'));
        $product->setInfoSecond($this->getDomVal($dom, 'infoSecond'));
        #$product->setIdentifier($this->getDomVal($dom, 'identifier'));
        $product->setArtist($this->getDomVal($dom, 'artist'));
        $product->setArtwork1($this->getDomVal($dom, 'artwork1'));
        $product->setArtwork2($this->getDomVal($dom, 'artwork2'));
        #$product->setProjectId($this->getDomVal($dom, 'projectId'));
        #$product->setId($this->getDomVal($dom, 'id'));

        $releaseDate = $this->getDomVal($dom, 'releaseDate');

        if ($releaseDate)
        {
            $product->setReleaseDate($this->toDate($releaseDate));
        }

        $product->setType($this->getDomVal($dom, 'type'));
        $product->setNotes($this->getDomVal($dom, 'notes'));
        #$product->setLabelId($this->getDomVal($dom, 'id'));

        // product-fields
        #$product->setId($this->getDomVal($dom, 'id'));
        $product->setCatalogNumber($this->getDomVal($dom, 'catalogNumber'));
        $product->setStreamYesNo($this->getDomVal($dom, 'streamYesNo'));
        #$product->setIdentifier($this->getDomVal($dom, 'identifier'));
        $product->setDigitalPhysical($this->getDomVal($dom, 'digitalPhysical'));
        #$product->setSupplierId($this->getDomVal($dom, 'supplierId'));
        $product->setWeight($this->getDomVal($dom, 'weight'));
        $product->setReleaseShift($this->getDomVal($dom, 'releaseShift'));
        #$product->setInfoEnglish($this->getDomVal($dom, 'infoEnglish'));
        #$product->setInfoSecond($this->getDomVal($dom, 'infoSecond'));
        #$product->setReleaseId($this->getDomVal($dom, 'releaseId'));
        $product->setDownloadYesNo($this->getDomVal($dom, 'downloadYesNo'));
        #$product->setDeliveryNow($this->getDomVal($dom, 'deliveryNow'));

        /*$deliveryConfirmedDate = $this->getDomVal($dom, 'deliveryConfirmedDate');

        if ($deliveryConfirmedDate)
        {
            $product->setDeliveryConfirmedDate($this->toDate($deliveryConfirmedDate));
        }*/

        $product->setBarcode($this->getDomVal($dom, 'barcode'));
        #$product->setDeliveredFlag($this->getDomVal($dom, 'deliveredFlag'));

        /*$deliveredDate = $this->getDomVal($dom, 'deliveredDate');

        if ($deliveredDate)
        {
            $product->setDeliveredDate($this->toDate($deliveredDate));
        }*/

        #$product->setDeliveryConfirmedFlag($this->getDomVal($dom, 'deliveryConfirmedFlag'));
        $product->setAttribute1($this->getDomVal($dom, 'attribute1'));
        $product->setAttribute2($this->getDomVal($dom, 'attribute2'));
        $product->setAttribute3($this->getDomVal($dom, 'attribute3'));
        #$product->setFormatId($this->getDomVal($dom, 'formatId'));
        $product->setArtworkProduct1($this->getDomVal($dom, 'artworkProduct1'));
        $product->setArtworkProduct2($this->getDomVal($dom, 'artworkProduct2'));
        #$product->setPriceCodeId($this->getDomVal($dom, 'priceCodeId'));
        $product->setLanguage($this->getDomVal($dom, 'language'));
        $product->setPpd($this->getDomVal($dom, 'ppd'));
        $product->setVersion($this->getDomVal($dom, 'version'));
        $product->setCostPrice($this->getDomVal($dom, 'costPrice'));
        $product->setNotes($this->getDomVal($dom, 'notes'));
        #$product->setTypeId($this->getDomVal($dom, 'typeId'));

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
            #$track->setId($this->getDomVal($t, 'id'));
            #$track->setProductIdMain($this->getDomVal($t, 'productIdMain'));
            #$track->setSongId($this->getDomVal($t, 'songId'));
            $track->setCountry($this->getDomVal($t, 'country'));
            $track->setArtworkTrack1($this->getDomVal($t, 'artworkTrack1'));
            $track->setVersion($this->getDomVal($t, 'version'));
            $track->setIsrc($this->getDomVal($t, 'isrc'));
            $track->setPYear($this->getDomVal($t, 'pYear'));
            $track->setPLine($this->getDomVal($t, 'pLine'));
            $track->setDigitalRightType($this->getDomVal($t, 'digitalRightType'));
            $track->setArtist($this->getDomVal($t, 'artist'));
            $track->setPlaytime($this->getDomVal($t, 'playtime'));
            $track->setTitle($this->getDomVal($t, 'title'));
            $track->setType($this->getDomVal($t, 'type'));
            $track->setExplicitFlag($this->getDomVal($t, 'explicitFlag'));
            $product->addTrack($track);
        }

        return $product;
    }
}