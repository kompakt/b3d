<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Canonical\Converter\Details;

use Kompakt\B3d\Details\Entity\Product as DetailsProduct;
use Kompakt\B3d\Canonical\Entity\Price as CanonicalPrice;
use Kompakt\B3d\Canonical\Entity\Product as CanonicalProduct;
use Kompakt\B3d\Canonical\Entity\Track as CanonicalTrack;

class Product
{
    protected $productPrototype = null;
    protected $trackPrototype = null;
    protected $pricePrototype = null;

    public function __construct(
        CanonicalProduct $productPrototype,
        CanonicalTrack $trackPrototype,
        CanonicalPrice $pricePrototype
    )
    {
        $this->productPrototype = $productPrototype;
        $this->trackPrototype = $trackPrototype;
        $this->pricePrototype = $pricePrototype;
    }

    public function map(DetailsProduct $detailsProduct)
    {
        $product = clone $this->productPrototype;

        // label fields
        if ($detailsProduct->getRelease()->getLabel())
        {
            $product->setLabel($detailsProduct->getRelease()->getLabel()->getName());
        }

        // release fields
        $product->setReleaseUuid($this->stripUtf($detailsProduct->getRelease()->getUuid()));
        $product->setReleaseArtwork1($this->stripUtf($detailsProduct->getRelease()->getArtwork1()));
        $product->setReleaseArtwork2($this->stripUtf($detailsProduct->getRelease()->getArtwork2()));
        $product->setReleaseIdentifier($this->stripUtf($detailsProduct->getRelease()->getIdentifier()));
        $product->setReleaseLabelId($this->stripUtf($detailsProduct->getRelease()->getLabelId()));
        $product->setReleaseNotes($this->stripUtf($detailsProduct->getRelease()->getNotes()));
        $product->setReleaseProjectId($this->stripUtf($detailsProduct->getRelease()->getProjectId()));
        $product->setReleaseArtist($this->stripUtf($detailsProduct->getRelease()->getReleaseArtist()));

        if ($detailsProduct->getRelease()->getReleaseDate())
        {
            $product->setReleaseDate($detailsProduct->getRelease()->getReleaseDate());
        }

        $product->setReleaseId($this->stripUtf($detailsProduct->getRelease()->getReleaseId()));
        $product->setReleaseInfoEnglish($this->stripUtf($detailsProduct->getRelease()->getReleaseInfoEnglish()));
        $product->setReleaseInfoSecond($this->stripUtf($detailsProduct->getRelease()->getReleaseInfoSecond()));
        $product->setReleaseTitle($this->stripUtf($detailsProduct->getRelease()->getReleaseTitle()));
        $product->setReleaseTitleAlt($this->stripUtf($detailsProduct->getRelease()->getReleaseTitleAlt()));
        $product->setReleaseType($this->stripUtf($detailsProduct->getRelease()->getReleaseType()));
        $product->setReleaseStatus($this->stripUtf($detailsProduct->getRelease()->getStatus()));

        // product fields
        $product->setUuid($this->stripUtf($detailsProduct->getUuid()));
        $product->setAltArtist($this->stripUtf($detailsProduct->getAltArtist()));
        $product->setAltTitle($this->stripUtf($detailsProduct->getAltTitle()));

        if ($detailsProduct->getProductDate())
        {
            $product->setProductDate($detailsProduct->getProductDate());
        }

        $product->setAlbumSingleMerch($this->stripUtf($detailsProduct->getAlbumSingleMerch()));
        $product->setArtworkProduct1($this->stripUtf($detailsProduct->getArtworkProduct1()));
        $product->setArtworkProduct2($this->stripUtf($detailsProduct->getArtworkProduct2()));
        $product->setAttribute1($this->stripUtf($detailsProduct->getAttribute1()));
        $product->setAttribute2($this->stripUtf($detailsProduct->getAttribute2()));
        $product->setAttribute3($this->stripUtf($detailsProduct->getAttribute3()));
        $product->setBarcode($this->stripUtf($detailsProduct->getBarcode()));
        $product->setCatalogNumber($this->stripUtf($detailsProduct->getCatalogNumber()));
        $product->setChannel($this->stripUtf($detailsProduct->getChannel()));
        $product->setCostPrice($this->stripUtf($detailsProduct->getCostPrice()));
        $product->setDefaultWeight($this->stripUtf($detailsProduct->getDefaultWeight()));
        $product->setDeliveredDate($detailsProduct->getDeliveredDate());
        $product->setDeliveredFlag($this->stripUtf($detailsProduct->getDeliveredFlag()));
        $product->setDeliveryConfirmedDate($detailsProduct->getDeliveryConfirmedDate());
        $product->setDeliveryConfirmedFlag($this->stripUtf($detailsProduct->getDeliveryConfirmedFlag()));
        $product->setDeliveryNow($this->stripUtf($detailsProduct->getDeliveryNow()));
        $product->setDigitalPhysical($this->stripUtf($detailsProduct->getDigitalPhysical()));
        $product->setDownloadYesNo($this->stripUtf($detailsProduct->getDownloadYesNo()));
        $product->setFormatId($this->stripUtf($detailsProduct->getFormatId()));
        $product->setFormatName($this->stripUtf($detailsProduct->getFormatName()));
        $product->setGroups($this->stripUtf($detailsProduct->getGroups()));
        $product->setHeadline($this->stripUtf($detailsProduct->getHeadline()));
        $product->setIdentifier($this->stripUtf($detailsProduct->getIdentifier()));
        $product->setInternalFlag($this->stripUtf($detailsProduct->getInternalFlag()));
        $product->setLanguage($this->stripUtf($detailsProduct->getLanguage()));
        $product->setMinMargin($this->stripUtf($detailsProduct->getMinMargin()));
        $product->setNotes($this->stripUtf($detailsProduct->getNotes()));
        $product->setPpd($this->stripUtf($detailsProduct->getPpd()));
        $product->setPriceCodeDescription($this->stripUtf($detailsProduct->getPriceCodeDescription()));
        $product->setPriceCodeId($this->stripUtf($detailsProduct->getPriceCodeId()));
        $product->setPriceCodeName($this->stripUtf($detailsProduct->getPriceCodeName()));
        $product->setProductId($this->stripUtf($detailsProduct->getProductId()));
        $product->setProductInfoEnglish($this->stripUtf($detailsProduct->getProductInfoEnglish()));
        $product->setProductInfoSecond($this->stripUtf($detailsProduct->getProductInfoSecond()));
        $product->setProductTypeId($this->stripUtf($detailsProduct->getProductTypeId()));
        $product->setProductTypeName($this->stripUtf($detailsProduct->getProductTypeName()));
        $product->setProductTypeId2($this->stripUtf($detailsProduct->getProductTypeId2()));
        $product->setProductTypeName2($this->stripUtf($detailsProduct->getProductTypeName2()));
        $product->setProformaPrice($this->stripUtf($detailsProduct->getProformaPrice()));
        $product->setReleaseId($this->stripUtf($detailsProduct->getReleaseId()));
        $product->setReleaseShift($this->stripUtf($detailsProduct->getReleaseShift()));
        $product->setStreamYesNo($this->stripUtf($detailsProduct->getStreamYesNo()));
        $product->setSupplierId($this->stripUtf($detailsProduct->getSupplierId()));
        $product->setTwoSidesFlag($this->stripUtf($detailsProduct->getTwoSidesFlag()));
        $product->setVatType($this->stripUtf($detailsProduct->getVatType()));
        $product->setVersion($this->stripUtf($detailsProduct->getVersion()));
        $product->setWeight($this->stripUtf($detailsProduct->getWeight()));

        foreach ($detailsProduct->getPrices() as $detailsPrice)
        {
            $price = clone $this->pricePrototype;
            $price->setCurrencyId($this->stripUtf($detailsPrice->getCurrencyId()));
            $price->setCurrencyIso($this->stripUtf($detailsPrice->getCurrencyIso()));
            $price->setExternalTable($this->stripUtf($detailsPrice->getExternalTable()));
            $price->setPayback($this->stripUtf($detailsPrice->getPayback()));
            $price->setPrice($this->stripUtf($detailsPrice->getPrice()));
            $price->setPricelistId($this->stripUtf($detailsPrice->getPricelistId()));
            $price->setPricelistName($this->stripUtf($detailsPrice->getPricelistName()));
            $price->setProductId($this->stripUtf($detailsPrice->getProductId()));
            $price->setProductPriceId($this->stripUtf($detailsPrice->getProductPriceId()));
            $product->addPrice($price);
        }

        foreach ($detailsProduct->getProductTracks() as $detailsProductTrack)
        {
            $track = clone $this->trackPrototype;

            // product-track fields
            $track->setSeqNo($this->stripUtf($detailsProductTrack->getSeqNo()));
            $track->setSetNo($this->stripUtf($detailsProductTrack->getSetNo()));
            $track->setBonusTrackFlag($this->stripUtf($detailsProductTrack->getBonusTrackFlag()));
            $track->setSide($this->stripUtf($detailsProductTrack->getSide()));
            $track->setProductIsrc($this->stripUtf($detailsProductTrack->getProductIsrc()));
            $track->setPlaytime($this->stripUtf($detailsProductTrack->getPlaytime()));

            // track fields
            $track->setUuid($this->stripUtf($detailsProductTrack->getTrack()->getUuid()));
            $track->setArtist($this->stripUtf($detailsProductTrack->getTrack()->getArtist()));
            $track->setArtworkTrack1($this->stripUtf($detailsProductTrack->getTrack()->getArtworkTrack1()));
            $track->setCountry($this->stripUtf($detailsProductTrack->getTrack()->getCountry()));
            $track->setDigitalRightType($this->stripUtf($detailsProductTrack->getTrack()->getDigitalRightType()));
            $track->setExplicitFlag($this->stripUtf($detailsProductTrack->getTrack()->getExplicitFlag()));
            $track->setIsrc($this->stripUtf($detailsProductTrack->getTrack()->getIsrc()));
            $track->setLanguage($this->stripUtf($detailsProductTrack->getTrack()->getLanguage()));
            $track->setPLine($this->stripUtf($detailsProductTrack->getTrack()->getPLine()));
            $track->setPYear($this->stripUtf($detailsProductTrack->getTrack()->getPYear()));
            #$track->setPlaytime($this->stripUtf($detailsProductTrack->getTrack()->getPlaytime()));
            $track->setProductIdMain($this->stripUtf($detailsProductTrack->getTrack()->getProductIdMain()));
            $track->setSongId($this->stripUtf($detailsProductTrack->getTrack()->getSongId()));
            $track->setTitle($this->stripUtf($detailsProductTrack->getTrack()->getTitle()));
            $track->setId($this->stripUtf($detailsProductTrack->getTrack()->getId()));
            $track->setType($this->stripUtf($detailsProductTrack->getTrack()->getType()));
            $track->setVersion($this->stripUtf($detailsProductTrack->getTrack()->getVersion()));
            $product->addTrack($track);
        }

        return $product;
    }

    protected function stripUtf($s)
    {
        // strip unwanted utf chars:
        // http://www.phpwact.org/php/i18n/charsets#common_problem_areas_with_utf-8
        return preg_replace('/[^\x{0009}\x{000a}\x{000d}\x{0020}-\x{D7FF}\x{E000}-\x{FFFD}]+/u', ' ', $s);
    }
}