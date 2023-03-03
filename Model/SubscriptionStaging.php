<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Model;

class SubscriptionStaging extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'pixafy_subscription_staging';
    protected $_cacheTag = 'pixafy_subscription_staging';
    protected $_eventPrefix = 'pixafy_subscription_staging';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Pixafy\Subscription\Model\ResourceModel\SubscriptionStaging');
    }

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return array
     */
    public function getDefaultValues():array
    {
        return [];
    }

    /**
     * @return int
     */
    public function getSubscriptionStagingId()
    {
        return $this->_getData('subscription_staging_id');
    }

    /**
     * @inheritDoc
     */
    public function setSubscriptionStagingId(?int $subscription_staging_id)
    {
        return $this->setData('subscription_staging_id', $subscription_staging_id);
    }

    /**
     * @return int
     */
    public function getSubscriptionId()
    {
        return $this->_getData('subscription_id');
    }

    /**
     * @inheritDoc
     */
    public function setSubscriptionId(?int $subscription_id)
    {
        return $this->setData('subscription_id', $subscription_id);
    }

    /**
     * @return string
     */
    public function getDateCreated()
    {
        return $this->_getData('date_created');
    }

    /**
     * @inheritDoc
     */
    public function setDateCreated(?string $date_created)
    {
        return $this->setData('date_created', $date_created);
    }

    /**
     * @return string
     */
    public function getDateScheduled()
    {
        return $this->_getData('date_scheduled');
    }

    /**
     * @inheritDoc
     */
    public function setDateScheduled(?string $date_scheduled)
    {
        return $this->setData('date_scheduled', $date_scheduled);
    }

    /**
     * @return int
     */
    public function getIsApproved()
    {
        return $this->_getData('is_approved');
    }

    /**
     * @inheritDoc
     */
    public function setIsApproved(?int $is_approved)
    {
        return $this->setData('is_approved', $is_approved);
    }

    /**
     * @return int
     */
    public function getIsExecuted()
    {
        return $this->_getData('is_executed');
    }

    /**
     * @inheritDoc
     */
    public function setIsExecuted(?int $is_executed)
    {
        return $this->setData('is_executed', $is_executed);
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->_getData('user_id');
    }

    /**
     * @inheritDoc
     */
    public function setUserId(?int $user_id)
    {
        return $this->setData('user_id', $user_id);
    }
}
