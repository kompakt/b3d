<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Util\File;

use Kompakt\B3d\Util\File\Exception\InvalidArgumentException;

class Writer
{
    public function write($data, $file)
    {
        $info = new \SplFileInfo(dirname($file));

        if (!$info->isDir())
        {
            throw new InvalidArgumentException(sprintf('File dir not found'));
        }

        if (!$info->isWritable())
        {
            throw new InvalidArgumentException(sprintf('File dir not writable'));
        }

        $fileInfo = new \SplFileInfo($file);

        if ($fileInfo->isFile())
        {
            unlink($file);
        }

        $h = fopen($file, 'w');
        fwrite($h, $data);
        fclose($h);
    }
}