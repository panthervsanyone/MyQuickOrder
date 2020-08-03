<?php


namespace ALevel\MyQuickOrder\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Status extends AbstractDb
{

    protected function _construct()
    {
        $this->_init('alevel_myquickorder_status', 'status_id');
    }
}
