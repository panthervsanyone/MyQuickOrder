<?php

namespace ALevel\MyQuickOrder\Model;

use ALevel\MyQuickOrder\Api\Model\OrderInterface;
use Magento\Framework\Model\AbstractModel;
use ALevel\MyQuickOrder\Model\ResourceModel\Order as ResourceModel;

class Order extends AbstractModel implements OrderInterface
{
    const LABEL = 'update_at';

    protected function _construct()
    {
        $this -> _init(ResourceModel::class);
    }
}
