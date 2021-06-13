<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Entity;

use Kompakt\B3d\Details\Entity\StockAccount;

class Stock
{
    protected $productUuid = null;
    protected $accounts = [];

    public function setProductUuid($productUuid)
    {
        $this->productUuid = $productUuid;
    }

    public function getProductUuid()
    {
        return $this->productUuid;
    }

    public function addAccount(StockAccount $account)
    {
        $this->accounts[$account->getId()] = $account;
    }

    public function getAccountById($id)
    {
        return
            (array_key_exists($id, $this->accounts))
            ? $this->accounts[$id]
            : null
        ;
    }

    public function getAccounts()
    {
        return $this->accounts;
    }
}