<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Model\ResourceModel\Subscription;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'subscription_id';
    protected $_eventPrefix = 'pixafy_subscription_collection';
    protected $_eventObject = 'pixafy_subscription_collection';

    /**
     * @inheirtDoc
     */
    protected function _construct()
    {
        $this->_init('Pixafy\Subscription\Model\Subscription', 'Pixafy\Subscription\Model\ResourceModel\Subscription');
    }
}
