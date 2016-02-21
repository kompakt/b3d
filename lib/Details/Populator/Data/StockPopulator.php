<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Populator\Data;

use Kompakt\B3d\Details\Endpoint\Resource\Stock\Mapper;
use Kompakt\B3d\Details\Populator\RepositoryInterface;

class StockPopulator
{
    protected $dataMapper = null;
    protected $repository = null;

    public function __construct(
        Mapper $dataMapper,
        RepositoryInterface $repository
    )
    {
        $this->dataMapper = $dataMapper;
        $this->repository = $repository;
    }

    public function populate(array $data)
    {
        foreach ($data as $productUuid => $stockAccounts)
        {
            $stockAccounts = ($stockAccounts) ? $stockAccounts : [];
            $entity = $this->dataMapper->map($productUuid, $stockAccounts);
            $this->repository->add($entity);
        }

        return $this->repository;
    }
}