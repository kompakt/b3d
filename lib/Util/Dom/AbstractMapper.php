<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Util\Dom;

use Kompakt\B3d\Util\Dom\Exception\DomainException;

abstract class AbstractMapper
{
    public function toDate($date)
    {
        return
            (preg_match('/\d{4,4}-\d{2,2}-\d{2,2}/', $date))
            ? \DateTime::createFromFormat('Y-m-d', $date)
            : null
        ;
    }

    protected function getDomElement($dom, $name)
    {
        $element = $dom->getElementsByTagName($name)->item(0);

        if (!$element)
        {
            throw new DomainException(sprintf('Xml element missing: "%s" in %s', $name, $this->file));
        }

        return $element;
    }

    protected function getDomVal($dom, $name)
    {
        $element = $dom->getElementsByTagName($name)->item(0);

        if (!$element)
        {
            throw new DomainException(sprintf('Xml element missing: "%s"', $name));
        }

        return $element->nodeValue;
    }
}