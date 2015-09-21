<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Generic\EventDispatcher;

interface EventAdapterInterface
{
    public function getGenericEvent();
    public function isPropagationStopped();
    public function stopPropagation();
}