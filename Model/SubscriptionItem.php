<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Model;

class SubscriptionItem extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'pixafy_subscription_item';
    protected $_cacheTag = 'pixafy_subscription_item';
    protected $_eventPrefix = 'pixafy_subscription_item';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Pixafy\Subscription\Model\ResourceModel\SubscriptionItem');
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
    public function getItmref()
    {
        return $this->_getData('itmref');
    }

    /**
     * @inheritDoc
     */
    public function setItmref(?string $itmref)
    {
        return $this->setData('itmref', $itmref);
    }

    /**
     * @return float
     */
    public function getPri()
    {
        return $this->_getData('pri');
    }

    /**
     * @inheritDoc
     */
    public function setPri(?float $pri)
    {
        return $this->setData('pri', $pri);
    }

    /**
     * @return int
     */
    public function getMinqty()
    {
        return $this->_getData('minqty');
    }

    /**
     * @inheritDoc
     */
    public function setMinqty(?int $minqty)
    {
        return $this->setData('minqty', $minqty);
    }

    /**
     * @return int
     */
    public function getMaxqty()
    {
        return $this->_getData('maxqty');
    }

    /**
     * @inheritDoc
     */
    public function setMaxqty(?int $maxqty)
    {
        return $this->setData('maxqty', $maxqty);
    }

    /**
     * @return string
     */
    public function getItmdesc()
    {
        return $this->_getData('itmdesc');
    }

    /**
     * @inheritDoc
     */
    public function setItmdesc(?string $itmdesc)
    {
        return $this->setData('itmdesc', $itmdesc);
    }

    /**
     * @return int
     */
    public function getQty()
    {
        return $this->_getData('qty');
    }

    /**
     * @inheritDoc
     */
    public function setQty(?int $qty)
    {
        return $this->setData('qty', $qty);
    }

    /**
     * @return int
     */
    public function getShipSite()
    {
        return $this->_getData('ship_site');
    }

    /**
     * @inheritDoc
     */
    public function setShipSite(?int $ship_site)
    {
        return $this->setData('ship_site', $ship_site);
    }

    /**
     * @return int
     */
    public function getItmstd()
    {
        return $this->_getData('itmstd');
    }

    /**
     * @inheritDoc
     */
    public function setItmstd(?int $itmstd)
    {
        return $this->setData('itmstd', $itmstd);
    }

    /**
     * @return string
     */
    public function getTsicod()
    {
        return $this->_getData('tsicod');
    }

    /**
     * @inheritDoc
     */
    public function setTsicod(?string $tsicod)
    {
        return $this->setData('tsicod', $tsicod);
    }
}
