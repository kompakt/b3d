<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Util\File;

use Kompakt\B3d\Util\File\Exception\InvalidArgumentException;

class Reader
{
    public function read($file)
    {
        $info = new \SplFileInfo($file);

        if (!$info->isFile())
        {
            throw new InvalidArgumentException(sprintf('File not found'));
        }

        if (!$info->isReadable())
        {
            throw new InvalidArgumentException(sprintf('File not readable'));
        }

        $handle = fopen($file, 'r');
        $fileContents = fread($handle, filesize($file));
        fclose($handle);
        return $fileContents;
    }
}