<?php
namespace ALevel\MyQuickOrder\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Listing extends Action
{

    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }

    public function _isAllowed()
    {
        return parent::_isAllowed();
    }
}
