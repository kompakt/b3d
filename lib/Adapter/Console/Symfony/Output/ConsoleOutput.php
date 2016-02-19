<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Adapter\Console\Symfony\Output;

use Kompakt\B3d\Generic\Console\Output\ConsoleOutputInterface as KompaktConsoleOutputInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface as SymfonyConsoleOutputInterface;

class ConsoleOutput implements KompaktConsoleOutputInterface
{
    protected $symfonyConsoleOutput = null;

    public function __construct(SymfonyConsoleOutputInterface $symfonyConsoleOutput)
    {
        $this->symfonyConsoleOutput = $symfonyConsoleOutput;
    }

    public function writeln($messages)
    {
        $this->symfonyConsoleOutput->writeln($messages);
    }
}
