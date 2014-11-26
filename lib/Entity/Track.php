<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Entity;

class Track
{
    protected $id = null;
    protected $productIdMain = null;
    protected $songId = null;
    protected $country = null;
    protected $artworkTrack1 = null;
    protected $version = null;
    protected $isrc = null;
    protected $pYear = null;
    protected $pLine = null;
    protected $digitalRightType = null;
    protected $artist = null;
    protected $playtime = null;
    protected $title = null;
    protected $type = null;
    protected $explicitFlag = null;

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }
}