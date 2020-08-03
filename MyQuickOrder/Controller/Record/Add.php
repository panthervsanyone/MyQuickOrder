<?php

namespace ALevel\MyQuickOrder\Controller\Record;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use ALevel\MyQuickOrder\Model\OrderFactory;
use Magento\Framework\DB\TransactionFactory;

class Add extends Action
{

  public function __construct(
          Context $context
      ) {
          parent::__construct($context);
      }


      public function execute()
      {
          $fullDate = date("y-m-d h:i:s");
          $name = $this->getRequest()->getParam('name');
          $phone = $this->getRequest()->getParam('phone');
          $email = $this->getRequest()->getParam('email');
          $sku = $this->getRequest()->getParam('sku');

          if ((isset($name) && $name !== '') &&
              (isset($phone) && $phone !== '') &&
              (isset($sku) && $sku !== '')) {

            $model = $this->_objectManager->create('ALevel\MyQuickOrder\Model\Order');
            $model->setName($name);
            $model->setSku($sku);
            $model->setPhone($phone);
            $model->setEmail($email);
            $model->setUpdate_at($fullDate);
            $model->setCreate_at($fullDate);
            $model->setStatus('During');
            $model->save();

          }

      }
}
