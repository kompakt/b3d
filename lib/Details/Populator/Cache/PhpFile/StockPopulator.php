<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Populator\Cache\PhpFile;

use Kompakt\B3d\Details\Populator\Data\StockPopulator as DataStockPopulator;
use Kompakt\B3d\Util\File\Reader;

class StockPopulator
{
    protected $populator = null;
    protected $fileReader = null;
    protected $filePathname = null;

    public function __construct(
        DataStockPopulator $populator,
        Reader $fileReader,
        $filePathname
    )
    {
        $this->populator = $populator;
        $this->fileReader = $fileReader;
        $this->filePathname = $filePathname;
    }

    public function populate()
    {
        $data = $this->fileReader->read($this->filePathname);
        return $this->populator->populate(unserialize($data));
    }
}