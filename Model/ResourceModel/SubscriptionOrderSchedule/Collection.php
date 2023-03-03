<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Model\ResourceModel\SubscriptionOrderSchedule;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'schedule_id';
    protected $_eventPrefix = 'pixafy_subscription_order_schedule_collection';
    protected $_eventObject = 'pixafy_subscription_order_schedule_collection';

    /**
     * @inheirtDoc
     */
    protected function _construct()
    {
        $this->_init('Pixafy\Subscription\Model\SubscriptionOrderSchedule', 'Pixafy\Subscription\Model\ResourceModel\SubscriptionOrderSchedule');
    }
}
