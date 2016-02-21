<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Populator\Endpoint;

use Kompakt\B3d\Details\Graph\PopulatorInterface;
use Kompakt\B3d\Details\Populator\DataMapperInterface;
use Kompakt\B3d\Details\Populator\Endpoint\EndpointInterface;
use Kompakt\B3d\Details\Populator\RepositoryInterface;
use Kompakt\B3d\Util\File\Reader;

class Populator implements PopulatorInterface
{
    protected $endpoint = null;
    protected $dataMapper = null;
    protected $repository = null;

    public function __construct(
        EndpointInterface $endpoint,
        DataMapperInterface $dataMapper,
        RepositoryInterface $repository
    )
    {
        $this->endpoint = $endpoint;
        $this->dataMapper = $dataMapper;
        $this->repository = $repository;
    }

    /**
     * @see PopulatorInterface::populate()
     */
    public function populate()
    {
        foreach ($this->endpoint->fetchAll() as $item)
        {
            $entity = $this->dataMapper->map($item);
            $this->repository->add($entity);
        }

        return $this->repository;
    }
}