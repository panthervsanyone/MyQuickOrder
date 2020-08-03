<?php

namespace ALevel\MyQuickOrder\UI\Component\Form;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use ALevel\MyQuickOrder\UI\Component\Form\GenericButton;

class BackButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

    /**
     * @return string
     */
    private function getBackUrl()
    {
        return $this->getUrl('*/*/listing');
    }
}
