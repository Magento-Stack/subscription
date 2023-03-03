<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Model;

class Subscription extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'pixafy_subscription';
    protected $_cacheTag = 'pixafy_subscription';
    protected $_eventPrefix = 'pixafy_subscription';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Pixafy\Subscription\Model\ResourceModel\Subscription');
    }

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return int
     */
    public function getCustomerId()
    {
        return $this->_getData('customer_id');
    }

    /**
     * @inheritDoc
     */
    public function setCustomerId(?int $customer_id)
    {
        return $this->setData('customer_id', $customer_id);
    }

    /**
     * @return int|null
     */
    public function getIncrementId()
    {
        return $this->_getData('increment_id');
    }

    /**
     * @inheritDoc
     */
    public function setIncrementId(?int $id)
    {
        return $this->setData('increment_id', $id);
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->_getData('name');
    }

    /**
     * @inheritDoc
     */
    public function setName(?string $name)
    {
        return $this->setData('name', $name);
    }

    /**
     * @return string|null
     */
    public function getBpcNum()
    {
        return $this->_getData('bpc_num');
    }

    /**
     * @inheritDoc
     */
    public function setBpcNum(?string $bpcnum)
    {
        return $this->setData('bpc_num', $bpcnum);
    }

    /**
     * @return string|null
     */
    public function getBpcName()
    {
        return $this->_getData('bpc_name');
    }

    /**
     * @inheritDoc
     */
    public function setBpcName(?string $bpcname)
    {
        return $this->setData('bpc_name', $bpcname);
    }

    /**
     * @return string|null
     */
    public function getDateCreated()
    {
        return $this->_getData('date_created');
    }

    /**
     * @inheritDoc
     */
    public function setDateCreated(?string $date)
    {
        return $this->setData('date_created', $date);
    }

    /**
     * @return int|null
     */
    public function getEnable()
    {
        return $this->_getData('enable');
    }

    /**
     * @inheritDoc
     */
    public function setEnable(?int $enable)
    {
        return $this->setData('enable', $enable);
    }

    /**
     * @return int|null
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
     * @return string|null
     */
    public function getSubscriptionIntervalType()
    {
        return $this->_getData('subscription_interval_type');
    }

    /**
     * @inheritDoc
     */
    public function setSubscriptionIntervalType(?string $subscription_interval_type)
    {
        return $this->setData('subscription_interval_type', $subscription_interval_type);
    }

    /**
     * @return int|null
     */
    public function getSubscriptionIntervalNumber()
    {
        return $this->_getData('subscription_interval_number');
    }

    /**
     * @inheritDoc
     */
    public function setSubscriptionIntervalNumber(?int $subscription_interval_number)
    {
        return $this->setData('subscription_interval_number', $subscription_interval_number);
    }

    /**
     * @return string|null
     */
    public function getSubscriptionIntervalLabel()
    {
        return $this->_getData('subscription_interval_label');
    }

    /**
     * @inheritDoc
     */
    public function setSubscriptionIntervalLabel(?string $subscription_interval_label)
    {
        return $this->setData('subscription_interval_label', $subscription_interval_label);
    }

    /**
     * @return string|null
     */
    public function getPonumber()
    {
        return $this->_getData('ponumber');
    }

    /**
     * @inheritDoc
     */
    public function setPonumber(?string $ponumber)
    {
        return $this->setData('ponumber', $ponumber);
    }

    /**
     * @return int|null
     */
    public function getUniqueId()
    {
        return $this->_getData('unique_id');
    }

    /**
     * @inheritDoc
     */
    public function setUniqueId(?int $unique_id)
    {
        return $this->setData('unique_id', $unique_id);
    }

    /**
     * @return string|null
     */
    public function getNextShipDate()
    {
        return $this->_getData('next_ship_date');
    }

    /**
     * @inheritDoc
     */
    public function setNextShipDate(?string $next_ship_date)
    {
        return $this->setData('next_ship_date', $next_ship_date);
    }

    /**
     * @return string|null
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

    /**
     * @return float|null
     */
    public function getTotalCost()
    {
        return $this->_getData('total_cost');
    }

    /**
     * @inheritDoc
     */
    public function setTotalCost(?float $TotalCost)
    {
        return $this->setData('total_cost', $TotalCost);
    }

    /**
     * @return int|null
     */
    public function getDisableConfirmation()
    {
        return $this->_getData('disable_confirmation');
    }

    /**
     * @inheritDoc
     */
    public function setDisableConfirmation(?int $DisableConfirmation)
    {
        return $this->setData('disable_confirmation', $DisableConfirmation);
    }

    /**
     * @return int|null
     */
    public function getX3OrderRebuildFlag()
    {
        return $this->_getData('x3_order_rebuild_flag');
    }

    /**
     * @inheritDoc
     */
    public function setX3OrderRebuildFlag(?int $X3OrderRebuildFlag)
    {
        return $this->setData('x3_order_rebuild_flag', $X3OrderRebuildFlag);
    }


    /**
     * @return array
     */
    public function getDefaultValues():array
    {
        return [];
    }
}
