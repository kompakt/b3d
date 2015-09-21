<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Entity;

use Kompakt\B3d\Details\Entity\Product;
use Kompakt\B3d\Details\Entity\Track;

class ProductTrack
{
    // associations
    protected $product = null;
    protected $track = null;

    // properties
    protected $seqNo = null;
    protected $setNo = null;
    protected $productTrackId = null;
    protected $bonusTrackFlag = null;
    protected $trackId = null;
    protected $productId = null;
    protected $side = null;
    protected $productIsrc = null;
    protected $playtime = null;

    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setTrack(Track $track)
    {
        $this->track = $track;
    }

    public function getTrack()
    {
        return $this->track;
    }

    public function setSeqNo($seqNo)
    {
        $this->seqNo = $seqNo;
    }

    public function getSeqNo()
    {
        return $this->seqNo;
    }

    public function setSetNo($setNo)
    {
        $this->setNo = $setNo;
    }

    public function getSetNo()
    {
        return $this->setNo;
    }

    public function setProductTrackId($productTrackId)
    {
        $this->productTrackId = $productTrackId;
    }

    public function getProductTrackId()
    {
        return $this->productTrackId;
    }

    public function setBonusTrackFlag($bonusTrackFlag)
    {
        $this->bonusTrackFlag = $bonusTrackFlag;
    }

    public function getBonusTrackFlag()
    {
        return $this->bonusTrackFlag;
    }

    public function setTrackId($trackId)
    {
        $this->trackId = $trackId;
    }

    public function getTrackId()
    {
        return $this->trackId;
    }

    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function setSide($side)
    {
        $this->side = $side;
    }

    public function getSide()
    {
        return $this->side;
    }

    public function setProductIsrc($productIsrc)
    {
        $this->productIsrc = $productIsrc;
    }

    public function getProductIsrc()
    {
        return $this->productIsrc;
    }

    public function setPlaytime($playtime)
    {
        $this->playtime = $playtime;
    }

    public function getPlaytime()
    {
        return $this->playtime;
    }
}