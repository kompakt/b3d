<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Generic\EventDispatcher;

use Kompakt\B3d\Generic\EventDispatcher\EventInterface;
use Kompakt\B3d\Generic\EventDispatcher\EventSubscriberInterface;

interface EventDispatcherInterface
{
    public function dispatch($eventName, EventInterface $event = null);
    public function addSubscriber(EventSubscriberInterface $subscriber);
    public function removeSubscriber(EventSubscriberInterface $subscriber);
    public function addListener($eventName, $listener, $priority = 0);
    public function removeListener($eventName, $listener);
}