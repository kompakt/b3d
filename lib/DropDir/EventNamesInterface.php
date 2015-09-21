<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\DropDir;

interface EventNamesInterface
{
    public function run();
    public function runError();
    public function end();
    public function endError();
    public function file();
    public function fileError();
}