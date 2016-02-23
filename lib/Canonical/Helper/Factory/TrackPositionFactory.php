<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Canonical\Helper\Factory;

use Kompakt\B3d\Canonical\Entity\Product;
use Kompakt\B3d\Canonical\Helper\TrackPosition;

class TrackPositionFactory
{
    public function getInstance(Product $product)
    {
        return new TrackPosition($product);
    }
}