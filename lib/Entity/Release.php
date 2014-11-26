<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Entity;

class Release
{
    protected $status = null;
    protected $title = null;
    protected $titleAlt = null;
    protected $infoEnglish = null;
    protected $infoSecond = null;
    protected $identifier = null;
    protected $artist = null;
    protected $UUID = null;
    protected $artwork1 = null;
    protected $artwork2 = null;
    protected $projectId = null;
    protected $id = null;
    protected $releaseDate = null;
    protected $lastModified = null;
    protected $type = null;
    protected $created = null;
    protected $notes = null;
    protected $labelId = null;

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }
}