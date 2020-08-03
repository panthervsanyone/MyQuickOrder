<?php


namespace ALevel\MyQuickOrder\Model\ResourceModel\Order;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

use ALevel\MyQuickOrder\Model\Order as Model;
use ALevel\MyQuickOrder\Model\ResourceModel\Order as ResourceModel;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
