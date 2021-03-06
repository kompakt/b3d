<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\Exception;

use Kompakt\B3d\Exception as BaseException;

class UnexpectedValueException extends \UnexpectedValueException implements BaseException
{}