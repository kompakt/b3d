<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\Stock;

use Kompakt\B3d\Details\Entity\Stock;
use Kompakt\B3d\Details\Entity\StockAccount;

class Mapper
{
    protected $stockPrototype = null;
    protected $stockAccountPrototype = null;

    public function __construct(Stock $stockPrototype, StockAccount $stockAccountPrototype)
    {
        $this->stockPrototype = $stockPrototype;
        $this->stockAccountPrototype = $stockAccountPrototype;
    }

    public function map($productUuid, array $accountsData)
    {
        $stock = clone $this->stockPrototype;
        $stock->setProductUuid($productUuid);

        foreach ($accountsData as $accountId => $accountData)
        {
            $stockAccount = clone $this->stockAccountPrototype;
            $stockAccount->setId($accountId);
            $stockAccount->setName($accountData['account_name']);
            $stockAccount->setQuantityUnreserved($accountData['stock_qty_unreserved']);
            $stockAccount->setQuantityFree($accountData['stock_qty_free']);
            $stockAccount->setQuantity($accountData['stock_qty']);
            $stock->addAccount($stockAccount);
        }

        return $stock;
    }
}