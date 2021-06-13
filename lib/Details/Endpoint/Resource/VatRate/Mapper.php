<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\VatRate;

use Kompakt\B3d\Details\Entity\VatRate;
use Kompakt\B3d\Details\Populator\DataMapperInterface;

class Mapper implements DataMapperInterface
{
    protected $vatRatePrototype = null;

    public function __construct(VatRate $vatRatePrototype)
    {
        $this->vatRatePrototype = $vatRatePrototype;
    }

    /**
     * @see DataMapperInterface::map()
     */
    public function map(array $data)
    {
        $vatRate = clone $this->vatRatePrototype;
        $vatRate->setUuid(trim($data['uuid']));
        $vatRate->setFormatName(trim($data['format_name']));
        $vatRate->setFormatId(trim($data['format_id']));
        $vatRate->setVatClass(trim($data['vat_class']));
        $vatRate->setVatClassName(trim($data['vat_class_name']));
        $vatRate->setVatTerritory(trim($data['vat_territory']));
        $vatRate->setVatRate(trim($data['vat_rate']));
        return $vatRate;
    }
}