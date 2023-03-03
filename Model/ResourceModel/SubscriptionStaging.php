<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Context;

class SubscriptionStaging extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * @inheriDoc
     */
    protected function _construct()
    {
        $this->_init('pixafy_subscription_staging', 'subscription_staging_id');
    }
}
