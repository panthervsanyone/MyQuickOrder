<?php

namespace ALevel\MyQuickOrder\Model;

use ALevel\MyQuickOrder\Api\Model\StatusInterface;
use Magento\Framework\Model\AbstractModel;
use ALevel\MyQuickOrder\Model\ResourceModel\Status as ResourceModel;

class Status extends AbstractModel implements StatusInterface
{
    const LABEL = 'update_at';

    protected function _construct()
    {
        $this -> _init(ResourceModel::class);
    }
}
