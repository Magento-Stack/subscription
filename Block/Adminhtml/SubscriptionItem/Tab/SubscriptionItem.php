<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Block\Adminhtml\SubscriptionItem\Tab;

//Subscription Item Tab
class SubscriptionItem extends \Magento\Framework\View\Element\Text\ListText implements
    \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('Subscription Items');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Subscription Items');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }
}
