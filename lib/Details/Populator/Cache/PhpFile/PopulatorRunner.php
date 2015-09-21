<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Populator\Cache\PhpFile;

use Kompakt\B3d\Details\Endpoint\Cache\DataMapperInterface;
use Kompakt\B3d\Details\Graph\PopulatorRunnerInterface;
use Kompakt\B3d\Details\Populator\RepositoryInterface;
use Kompakt\B3d\Util\File\Reader;

class PopulatorRunner implements PopulatorRunnerInterface
{
    protected $fileReader = null;
    protected $dataMapper = null;
    protected $repository = null;
    protected $filePathname = null;

    public function __construct(
        Reader $fileReader,
        DataMapperInterface $dataMapper,
        RepositoryInterface $repository,
        $filePathname
    )
    {
        $this->fileReader = $fileReader;
        $this->dataMapper = $dataMapper;
        $this->repository = $repository;
        $this->filePathname = $filePathname;
    }

    /**
     * @see PopulatorRunnerInterface::run()
     */
    public function run()
    {
        $data = $this->fileReader->read($this->filePathname);
        $items = unserialize($data);

        foreach ($items as $item)
        {
            $entity = $this->dataMapper->map($item);
            $this->repository->add($entity);
        }
    }
}