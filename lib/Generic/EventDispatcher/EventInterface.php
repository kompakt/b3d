<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Generic\EventDispatcher;

use Kompakt\B3d\Generic\EventDispatcher\EventAdapterInterface;

interface EventInterface
{
    public function setAdapter(EventAdapterInterface $adapter);
    public function isPropagationStopped();
    public function stopPropagation($avoidCircularDependency = false);
}