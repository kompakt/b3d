<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Entity;

class Artist
{
    protected $name = null;
    protected $last_modified = null;
    protected $mechanical_id = null;
    protected $created = null;
    protected $bio_engl = null;
    protected $notes = null;
    protected $artwork1 = null;
    protected $artwork2 = null;
    protected $bio_own = null;
    protected $url1 = null;
    protected $url2 = null;
    protected $labelArtistId = null;
    protected $UUID = null;
    protected $sortName = null;
    protected $amgId = null;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}