<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Populator\Endpoint;

use Kompakt\B3d\Details\Populator\DataMapperInterface;
use Kompakt\B3d\Details\Graph\PopulatorRunnerInterface;
use Kompakt\B3d\Details\Populator\RepositoryInterface;
use Kompakt\B3d\Util\File\Reader;

class PopulatorRunner implements PopulatorRunnerInterface
{
    protected $endpoint = null;
    protected $dataMapper = null;
    protected $repository = null;

    public function __construct(
        $endpoint,
        DataMapperInterface $dataMapper,
        RepositoryInterface $repository
    )
    {
        $this->endpoint = $endpoint;
        $this->dataMapper = $dataMapper;
        $this->repository = $repository;
    }

    /**
     * @see PopulatorRunnerInterface::run()
     */
    public function run()
    {
        foreach ($this->endpoint->fetchAll() as $item)
        {
            $entity = $this->dataMapper->map($item);
            $this->repository->add($entity);
        }
    }
}