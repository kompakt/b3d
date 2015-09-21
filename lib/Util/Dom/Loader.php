<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Util\Dom;

use Kompakt\B3d\Util\Dom\Exception\InvalidArgumentException;

class Loader
{
    public function load($xml)
    {
        set_error_handler(function($errno, $errstr, $errfile = null, $errline = null, array $errcontext = null)
        {
            throw new InvalidArgumentException($errstr);
        });

        $dom = new \DOMDocument();

        $dom->loadXml($xml);
        restore_error_handler();

        return $dom;
    }
}