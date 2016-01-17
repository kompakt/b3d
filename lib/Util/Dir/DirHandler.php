<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Util\Dir;

class DirHandler
{
    protected $dir = null;
    protected $suffix = null;

    public function __construct($dir, $suffix = 'xml')
    {
        $this->dir = new \DirectoryIterator($dir);
        $this->suffix = $suffix;
    }

    public function deleteAllFiles()
    {
        foreach ($this->dir as $fileInfo)
        {
            if (preg_match(sprintf('/.%s$/', $this->suffix), $fileInfo->getFilename()))
            {
                unlink($fileInfo->getPathname());
            }
        }
    }
}
