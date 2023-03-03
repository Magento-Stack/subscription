<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Model;

class SubscriptionOrderSchedule extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'pixafy_subscription_order_schedule';
    protected $_cacheTag = 'pixafy_subscription_order_schedule';
    protected $_eventPrefix = 'pixafy_subscription_order_schedule';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Pixafy\Subscription\Model\ResourceModel\SubscriptionOrderSchedule');
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
    public function getScheduleId()
    {
        return $this->_getData('schedule_id');
    }

    /**
     * @inheritDoc
     */
    public function setScheduleId(?int $schedule_id)
    {
        return $this->setData('schedule_id', $schedule_id);
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
     * @return int
     */
    public function getIsValid()
    {
        return $this->_getData('is_valid');
    }

    /**
     * @inheritDoc
     */
    public function setIsValid(?int $is_valid)
    {
        return $this->setData('is_valid', $is_valid);
    }

    /**
     * @return int
     */
    public function getIsPosted()
    {
        return $this->_getData('is_posted');
    }

    /**
     * @inheritDoc
     */
    public function setIsPosted(?int $is_posted)
    {
        return $this->setData('is_posted', $is_posted);
    }

    /**
     * @return string
     */
    public function getExpectedDeliveryDate()
    {
        return $this->_getData('expected_delivery_date');
    }

    /**
     * @inheritDoc
     */
    public function seteExpectedDeliveryDate(?string $expected_delivery_date)
    {
        return $this->setData('expected_delivery_date', $expected_delivery_date);
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->_getData('created_at');
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt(?string $created_at)
    {
        return $this->setData('created_at', $created_at);
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->_getData('updated_at');
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt(?string $updated_at)
    {
        return $this->setData('updated_at', $updated_at);
    }
}
