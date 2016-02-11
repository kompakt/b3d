<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Populator\Cache\PhpFile;

use Kompakt\B3d\Details\Endpoint\Resource\Stock\Mapper;
use Kompakt\B3d\Details\Populator\RepositoryInterface;
use Kompakt\B3d\Util\File\Reader;

class StockPopulatorRunner
{
    protected $fileReader = null;
    protected $dataMapper = null;
    protected $repository = null;
    protected $filePathname = null;

    public function __construct(
        Reader $fileReader,
        Mapper $dataMapper,
        RepositoryInterface $repository,
        $filePathname
    )
    {
        $this->fileReader = $fileReader;
        $this->dataMapper = $dataMapper;
        $this->repository = $repository;
        $this->filePathname = $filePathname;
    }

    public function run()
    {
        $data = $this->fileReader->read($this->filePathname);
        $items = unserialize($data);

        foreach ($items as $productUuid => $stockAccounts)
        {
            $stockAccounts = ($stockAccounts) ? $stockAccounts : [];
            $entity = $this->dataMapper->map($productUuid, $stockAccounts);
            $this->repository->add($entity);
        }
    }
}