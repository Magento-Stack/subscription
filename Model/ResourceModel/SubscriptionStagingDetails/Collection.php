<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Model\ResourceModel\SubscriptionStagingDetails;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'subscription_staging_details_id';
    protected $_eventPrefix = 'pixafy_subscription_staging_details_collection';
    protected $_eventObject = 'pixafy_subscription_staging_details_collection';

    /**
     * @inheirtDoc
     */
    protected function _construct()
    {
        $this->_init('Pixafy\Subscription\Model\SubscriptionStagingDetails', 'Pixafy\Subscription\Model\ResourceModel\SubscriptionStagingDetails');
    }
}
