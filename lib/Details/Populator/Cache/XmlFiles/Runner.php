<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Populator\Cache\XmlFiles;

use Kompakt\B3d\Adapter\EventDispatcher\Symfony\EventDispatcher;
use Kompakt\B3d\DropDir\DropDir;
use Kompakt\B3d\Generic\EventDispatcher\EventSubscriberInterface;
use Kompakt\B3d\Details\Graph\PopulatorRunnerInterface;

class Runner implements PopulatorRunnerInterface
{
    protected $dispatcher = null;
    protected $loader = null;
    protected $dropDir = null;
    protected $dirIterator = null;

    public function __construct(
        EventDispatcher $dispatcher,
        EventSubscriberInterface $loader,
        DropDir $dropDir,
        \DirectoryIterator $dirIterator
    )
    {
        $this->dispatcher = $dispatcher;
        $this->loader = $loader;
        $this->dropDir = $dropDir;
        $this->dirIterator = $dirIterator;
    }

    /**
     * @see PopulatorRunnerInterface::run()
     */
    public function run()
    {
        $this->dispatcher->addSubscriber($this->loader);
        $this->dropDir->open($this->dirIterator);
        $this->dispatcher->removeSubscriber($this->loader);
    }
}