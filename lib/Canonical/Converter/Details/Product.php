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
        $product->setReleaseUuid($detailsProduct->getRelease()->getUuid());
        $product->setReleaseArtwork1($detailsProduct->getRelease()->getArtwork1());
        $product->setReleaseArtwork2($detailsProduct->getRelease()->getArtwork2());
        $product->setReleaseIdentifier($detailsProduct->getRelease()->getIdentifier());
        $product->setReleaseLabelId($detailsProduct->getRelease()->getLabelId());
        $product->setReleaseNotes($detailsProduct->getRelease()->getNotes());
        $product->setReleaseProjectId($detailsProduct->getRelease()->getProjectId());
        $product->setReleaseArtist($detailsProduct->getRelease()->getReleaseArtist());
        $product->setReleaseDate($detailsProduct->getRelease()->getReleaseDate());
        $product->setReleaseId($detailsProduct->getRelease()->getReleaseId());
        $product->setReleaseInfoEnglish($detailsProduct->getRelease()->getReleaseInfoEnglish());
        $product->setReleaseInfoSecond($detailsProduct->getRelease()->getReleaseInfoSecond());
        $product->setReleaseTitle($detailsProduct->getRelease()->getReleaseTitle());
        $product->setReleaseTitleAlt($detailsProduct->getRelease()->getReleaseTitleAlt());
        $product->setReleaseType($detailsProduct->getRelease()->getReleaseType());
        $product->setReleaseStatus($detailsProduct->getRelease()->getStatus());

        // product fields
        $product->setUuid($detailsProduct->getUuid());
        $product->setAlbumSingleMerch($detailsProduct->getAlbumSingleMerch());
        $product->setArtworkProduct1($detailsProduct->getArtworkProduct1());
        $product->setArtworkProduct2($detailsProduct->getArtworkProduct2());
        $product->setAttribute1($detailsProduct->getAttribute1());
        $product->setAttribute2($detailsProduct->getAttribute2());
        $product->setAttribute3($detailsProduct->getAttribute3());
        $product->setBarcode($detailsProduct->getBarcode());
        $product->setCatalogNumber($detailsProduct->getCatalogNumber());
        $product->setChannel($detailsProduct->getChannel());
        $product->setCostPrice($detailsProduct->getCostPrice());
        $product->setDefaultWeight($detailsProduct->getDefaultWeight());
        $product->setDeliveredDate($detailsProduct->getDeliveredDate());
        $product->setDeliveredFlag($detailsProduct->getDeliveredFlag());
        $product->setDeliveryConfirmedDate($detailsProduct->getDeliveryConfirmedDate());
        $product->setDeliveryConfirmedFlag($detailsProduct->getDeliveryConfirmedFlag());
        $product->setDeliveryNow($detailsProduct->getDeliveryNow());
        $product->setDigitalPhysical($detailsProduct->getDigitalPhysical());
        $product->setDownloadYesNo($detailsProduct->getDownloadYesNo());
        $product->setFormatId($detailsProduct->getFormatId());
        $product->setFormatName($detailsProduct->getFormatName());
        $product->setGroups($detailsProduct->getGroups());
        $product->setIdentifier($detailsProduct->getIdentifier());
        $product->setInternalFlag($detailsProduct->getInternalFlag());
        $product->setLanguage($detailsProduct->getLanguage());
        $product->setMinMargin($detailsProduct->getMinMargin());
        $product->setNotes($detailsProduct->getNotes());
        $product->setPpd($detailsProduct->getPpd());
        $product->setPriceCodeDescription($detailsProduct->getPriceCodeDescription());
        $product->setPriceCodeId($detailsProduct->getPriceCodeId());
        $product->setPriceCodeName($detailsProduct->getPriceCodeName());
        $product->setProductId($detailsProduct->getProductId());
        $product->setProductInfoEnglish($detailsProduct->getProductInfoEnglish());
        $product->setProductInfoSecond($detailsProduct->getProductInfoSecond());
        $product->setProductTypeId($detailsProduct->getProductTypeId());
        $product->setProductTypeName($detailsProduct->getProductTypeName());
        $product->setProductTypeName2($detailsProduct->getProductTypeName2());
        $product->setProformaPrice($detailsProduct->getProformaPrice());
        $product->setReleaseId($detailsProduct->getReleaseId());
        $product->setReleaseShift($detailsProduct->getReleaseShift());
        $product->setStreamYesNo($detailsProduct->getStreamYesNo());
        $product->setSupplierId($detailsProduct->getSupplierId());
        $product->setTwoSidesFlag($detailsProduct->getTwoSidesFlag());
        $product->setVatType($detailsProduct->getVatType());
        $product->setVersion($detailsProduct->getVersion());
        $product->setWeight($detailsProduct->getWeight());

        foreach ($detailsProduct->getPrices() as $detailsPrice)
        {
            $price = clone $this->pricePrototype;
            $price->setCurrencyId($detailsPrice->getCurrencyId());
            $price->setCurrencyIso($detailsPrice->getCurrencyIso());
            $price->setExternalTable($detailsPrice->getExternalTable());
            $price->setPayback($detailsPrice->getPayback());
            $price->setPrice($detailsPrice->getPrice());
            $price->setPricelistId($detailsPrice->getPricelistId());
            $price->setPricelistName($detailsPrice->getPricelistName());
            $price->setProductId($detailsPrice->getProductId());
            $price->setProductPriceId($detailsPrice->getProductPriceId());
            $product->addPrice($price);
        }

        foreach ($detailsProduct->getProductTracks() as $detailsProductTrack)
        {
            $track = clone $this->trackPrototype;

            // product-track fields
            $track->setSeqNo($detailsProductTrack->getSeqNo());
            $track->setSetNo($detailsProductTrack->getSetNo());
            $track->setBonusTrackFlag($detailsProductTrack->getBonusTrackFlag());
            $track->setSide($detailsProductTrack->getSide());
            $track->setProductIsrc($detailsProductTrack->getProductIsrc());
            #$track->setPlaytime($detailsProductTrack->getPlaytime());

            // track fields
            $track->setCountry($detailsProductTrack->getTrack()->getCountry());
            $track->setArtworkTrack1($detailsProductTrack->getTrack()->getArtworkTrack1());
            $track->setVersion($detailsProductTrack->getTrack()->getVersion());
            $track->setIsrc($detailsProductTrack->getTrack()->getIsrc());
            $track->setPYear($detailsProductTrack->getTrack()->getPYear());
            $track->setPLine($detailsProductTrack->getTrack()->getPLine());
            $track->setDigitalRightType($detailsProductTrack->getTrack()->getDigitalRightType());
            $track->setArtist($detailsProductTrack->getTrack()->getArtist());
            $track->setPlaytime($detailsProductTrack->getTrack()->getPlaytime());
            $track->setTitle($detailsProductTrack->getTrack()->getTitle());
            $track->setType($detailsProductTrack->getTrack()->getType());
            $track->setExplicitFlag($detailsProductTrack->getTrack()->getExplicitFlag());

            $product->addTrack($track);
        }

        return $product;
    }
}