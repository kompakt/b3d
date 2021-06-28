<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Repository;

use Kompakt\B3d\Details\Entity\VatRate;
use Kompakt\B3d\Details\Populator\RepositoryInterface;

class VatRateRepository implements RepositoryInterface
{
    protected $vatRates = [];
    protected $territories = [];

    /**
     * @see RepositoryInterface::add()
     */
    public function add($vatRate)
    {
        $this->addVatRate($vatRate);
    }

    public function getByTerritoryAndFormatId($territory, $formatId)
    {
        if (array_key_exists($territory, $this->territories))
        {
            if (array_key_exists($formatId, $this->territories[$territory]))
            {
                return $this->territories[$territory][$formatId];
            }
        }

        return null;
    }

    public function getAll()
    {
        return $this->vatRates;
    }

    protected function addVatRate(VatRate $vatRate)
    {
        $this->vatRates[] = $vatRate;

        $territory = $vatRate->getVatTerritory();
        $formatId = $vatRate->getFormatId();

        if (!array_key_exists($territory, $this->territories))
        {
            $this->territories[$territory] = [];
        }

        $this->territories[$territory][$formatId] = $vatRate;
    }
}