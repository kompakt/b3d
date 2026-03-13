<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\VatRate;

use Kompakt\B3d\Details\Endpoint\Resource\BaseMapper;
use Kompakt\B3d\Details\Entity\VatRate;
use Kompakt\B3d\Details\Populator\DataMapperInterface;

class Mapper extends BaseMapper implements DataMapperInterface
{
    protected $vatRatePrototype = null;

    public function __construct(VatRate $vatRatePrototype)
    {
        $this->vatRatePrototype = $vatRatePrototype;
    }

    public function map(array $data)
    {
        $vatRate = clone $this->vatRatePrototype;
        $vatRate->setUuid($this->trim($data['uuid']));
        $vatRate->setFormatName($this->trim($data['format_name']));
        $vatRate->setFormatId($this->trim($data['format_id']));
        $vatRate->setVatClass($this->trim($data['vat_class']));
        $vatRate->setVatClassName($this->trim($data['vat_class_name']));
        $vatRate->setVatTerritory($this->trim($data['vat_territory']));
        $vatRate->setVatRate($this->trim($data['vat_rate']));
        return $vatRate;
    }
}