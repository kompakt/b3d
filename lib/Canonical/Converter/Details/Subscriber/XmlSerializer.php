<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Canonical\Converter\Details\Subscriber;

use Kompakt\B3d\Canonical\Entity\Product as CanonicalProduct;
use Kompakt\B3d\Canonical\Serializer\Xml\Product as ProductXmlSerializer;
use Kompakt\CollectionRunner\EventNamesInterface;
use Kompakt\CollectionRunner\Event\ItemEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class XmlSerializer
{
    protected $dispatcher = null;
    protected $eventNames = null;
    protected $serializer = null;

    public function __construct(
        EventDispatcherInterface $dispatcher,
        EventNamesInterface $eventNames,
        ProductXmlSerializer $serializer
    )
    {
        $this->dispatcher = $dispatcher;
        $this->eventNames = $eventNames;
        $this->serializer = $serializer;
    }

    public function activate()
    {
        $this->handleListeners(true);
    }

    public function deactivate()
    {
        $this->handleListeners(false);
    }

    public function onItem(ItemEvent $event)
    {
        $this->handleCanonicalProduct($event->getItem());
    }

    protected function handleCanonicalProduct(CanonicalProduct $canonicalProduct)
    {
        $this->serializer->serialize($canonicalProduct);
    }

    protected function handleListeners($add)
    {
        $method = ($add) ? 'addListener' : 'removeListener';

        $this->dispatcher->$method(
            $this->eventNames->item(),
            [$this, 'onItem']
        );
    }
}