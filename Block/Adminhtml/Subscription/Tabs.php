<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Block\Adminhtml\Subscription;

use Magento\Backend\Block\Widget\Tabs as WidgetTabs;

//BLock file to create tabs
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{

    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('pixafy_subscription_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Subscription'));
    }
}
