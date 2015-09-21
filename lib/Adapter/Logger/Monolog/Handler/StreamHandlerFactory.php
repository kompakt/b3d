<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Adapter\Logger\Monolog\Handler;

use Kompakt\B3d\Generic\Logger\Handler\StreamHandlerFactoryInterface;
use Kompakt\B3d\Generic\Logger\LoggerInterface;
use Monolog\Handler\StreamHandler as MonologStreamhandler;

class StreamHandlerFactory implements StreamHandlerFactoryInterface
{
    public function getInstance($stream, $level = LoggerInterface::DEBUG)
    {
        return new MonologStreamhandler($stream, $level);
    }
}