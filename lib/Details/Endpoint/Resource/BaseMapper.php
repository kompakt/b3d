<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource;

abstract class BaseMapper
{
    protected function trim($v)
    {
        return trim($v ?: '');
    }
}