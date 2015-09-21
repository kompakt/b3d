<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Generic\Logger\Handler;

use Kompakt\B3d\Generic\Logger\LoggerInterface;

interface StreamHandlerFactoryInterface
{
    public function getInstance($stream, $level = LoggerInterface::DEBUG);
}