<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Graph;

class DataFileHandler
{
    protected $artistDataFile = null;
    protected $labelDataFile = null;
    protected $priceDataFile = null;
    protected $productDataFile = null;
    protected $productTrackDataFile = null;
    protected $releaseDataFile = null;
    protected $trackDataFile = null;

    public function __construct(
        $artistDataFile,
        $labelDataFile,
        $priceDataFile,
        $productDataFile,
        $productTrackDataFile,
        $releaseDataFile,
        $trackDataFile
    )
    {
        $this->artistDataFile = $artistDataFile;
        $this->labelDataFile = $labelDataFile;
        $this->priceDataFile = $priceDataFile;
        $this->productDataFile = $productDataFile;
        $this->productTrackDataFile = $productTrackDataFile;
        $this->releaseDataFile = $releaseDataFile;
        $this->trackDataFile = $trackDataFile;
    }

    public function deleteAllFiles()
    {
        if (is_file($this->artistDataFile) && is_writeable($this->artistDataFile))
        {
            unlink($this->artistDataFile);
        }

        if (is_file($this->labelDataFile) && is_writeable($this->labelDataFile))
        {
            unlink($this->labelDataFile);
        }

        if (is_file($this->priceDataFile) && is_writeable($this->priceDataFile))
        {
            unlink($this->priceDataFile);
        }

        if (is_file($this->productDataFile) && is_writeable($this->productDataFile))
        {
            unlink($this->productDataFile);
        }

        if (is_file($this->productTrackDataFile) && is_writeable($this->productTrackDataFile))
        {
            unlink($this->productTrackDataFile);
        }

        if (is_file($this->releaseDataFile) && is_writeable($this->releaseDataFile))
        {
            unlink($this->releaseDataFile);
        }

        if (is_file($this->trackDataFile) && is_writeable($this->trackDataFile))
        {
            unlink($this->trackDataFile);
        }
    }

    public function hasRequiredFiles()
    {
        if (!is_file($this->artistDataFile))
        {
            return false;
        }

        if (!is_file($this->labelDataFile))
        {
            return false;
        }

        if (!is_file($this->priceDataFile))
        {
            return false;
        }

        if (!is_file($this->productDataFile))
        {
            return false;
        }

        if (!is_file($this->productTrackDataFile))
        {
            return false;
        }

        if (!is_file($this->releaseDataFile))
        {
            return false;
        }

        if (!is_file($this->trackDataFile))
        {
            return false;
        }

        return true;
    }
}
