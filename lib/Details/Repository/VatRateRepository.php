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
    protected $uuids = array();

    /**
     * @see RepositoryInterface::add()
     */
    public function add($vatRate)
    {
        $this->addVatRate($vatRate);
    }

    public function getByUuid($uuid)
    {
        return
            (array_key_exists($uuid, $this->uuids))
            ? $this->uuids[$uuid]
            : null
        ;
    }

    public function getAll()
    {
        return $this->uuids;
    }

    protected function addVatRate(VatRate $vatRate)
    {
        $this->uuids[$vatRate->getUuid()] = $vatRate;
    }
}