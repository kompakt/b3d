<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Entity;

class StockAccount
{
    protected $id = null;
    protected $name = null;
    protected $quantityUnreserved = 0;
    protected $quantityFree = 0;
    protected $quantity = 0;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setQuantityUnreserved($quantityUnreserved)
    {
        $this->quantityUnreserved = $quantityUnreserved;
    }

    public function getQuantityUnreserved()
    {
        return $this->quantityUnreserved;
    }

    public function setQuantityFree($quantityFree)
    {
        $this->quantityFree = $quantityFree;
    }

    public function getQuantityFree()
    {
        return $this->quantityFree;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }
}