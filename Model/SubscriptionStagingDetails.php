<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Model;

class SubscriptionStagingDetails extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'pixafy_subscription_staging_details';
    protected $_cacheTag = 'pixafy_subscription_staging_details';
    protected $_eventPrefix = 'pixafy_subscription_staging_details';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Pixafy\Subscription\Model\ResourceModel\SubscriptionStagingDetails');
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
    public function getSubscriptionStagingDetailsId()
    {
        return $this->_getData('subscription_staging_details_id');
    }

    /**
     * @inheritDoc
     */
    public function setSubscriptionStagingDetailsId(?int $subscription_staging_details_id)
    {
        return $this->setData('subscription_staging_details_id', $subscription_staging_details_id);
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
     * @return string
     */
    public function getFieldName()
    {
        return $this->_getData('field_name');
    }

    /**
     * @inheritDoc
     */
    public function setFieldName(?string $field_name)
    {
        return $this->setData('field_name', $field_name);
    }

    /**
     * @return string
     */
    public function getOldValue()
    {
        return $this->_getData('old_value');
    }

    /**
     * @inheritDoc
     */
    public function setOldValue(?string $old_value)
    {
        return $this->setData('old_value', $old_value);
    }

    /**
     * @return string
     */
    public function getNewValue()
    {
        return $this->_getData('new_value');
    }

    /**
     * @inheritDoc
     */
    public function setNewValue(?string $new_value)
    {
        return $this->setData('new_value', $new_value);
    }

    /**
     * @return string
     */
    public function getNotes()
    {
        return $this->_getData('notes');
    }

    /**
     * @inheritDoc
     */
    public function setNotes(?string $notes)
    {
        return $this->setData('notes', $notes);
    }
}
