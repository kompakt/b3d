<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Canonical\Helper;

use Kompakt\B3d\Canonical\Entity\Product;
use Kompakt\B3d\Canonical\Entity\Track;

class TrackPosition
{
    protected $sets = [];

    public function __construct(Product $product)
    {
        $hasError = false;

        foreach ($product->getTracks() as $track)
        {
            $set = (int) $track->getSetNo();
            $sequence = (int) $track->getSeqNo();

            if (!$set || !$sequence)
            {
                $hasError = true;
                continue;
            }

            if (!array_key_exists($set, $this->sets))
            {
                $this->sets[$set] = [];
            }

            if (array_key_exists($sequence, $this->sets[$set]))
            {
                $hasError = true;
                continue;
            }

            $this->sets[$set][$sequence] = 1;
        }

        if ($hasError)
        {
            $this->sets = [];
        }
    }

    public function getPosition(Track $track)
    {
        $set = (int) $track->getSetNo();
        $sequence = (int) $track->getSeqNo();

        if (!array_key_exists($set, $this->sets))
        {
            return 1;
        }

        if (!array_key_exists($sequence, $this->sets[$set]))
        {
            return 1;
        }

        if (!$set)
        {
            return 1;
        }

        if ($set === 1)
        {
            return $sequence;
        }

        $position = 0;

        for ($x = 1; $x < $set; $x++)
        {
            if (array_key_exists($x, $this->sets))
            {
                $position += count($this->sets[$x]);
            }
        }

        return $position + $sequence;
    }
}