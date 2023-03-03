<?php
/**
 * Pixafy_Subscription extension
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category  Pixafy
 * @package   Pixafy_Subscription
 * @copyright Copyright (c) 2022
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */
declare(strict_types=1);

namespace Pixafy\Subscription\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Store\Model\ScopeInterface;

/**
 * Helper Class
 */
class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_PATH_IS_ENABLE = 'pix_subscription/general/enable';
    const XML_PATH_X3_VISIBILITY_PERIOD = 'pix_subscription/general/x3_period';
    const XML_PATH_MAGENTO_VISIBILITY_PERIOD = 'pix_subscription/general/magento_period';
    const XML_PATH_ORDER_LOCK_PERIOD = 'pix_subscription/general/order_lock_period';
    const XML_PATH_ORDER_LOCK_MESSAGE = 'pix_subscription/general/order_lock_msg';
    const XML_PATH_SUBSCRIPTION_PERIOD_ENABLE = 'pix_subscription/subscription_periods/enable';
    const XML_PATH_SUBSCRIPTION_PERIOD_INTERVALS = 'pix_subscription/subscription_periods/intervals';

    /**
     * @var Json
     */
    protected Json $serialize;

    /**
     * @param Context $context
     * @param Json $serialize
     */
    public function __construct(
        Context $context,
        Json $serialize
    ) {
        $this->serialize = $serialize;
        parent::__construct($context);
    }

    /**
     * @param $field
     * @param $storeId
     * @return mixed
     */
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue($field, ScopeInterface::SCOPE_STORE, $storeId);
    }

    /**
     * @return mixed
     */
    public function isSubscriptionEnable()
    {
        return $this->getConfigValue(self::XML_PATH_IS_ENABLE);
    }

    /**
     * @return mixed
     */
    public function getX3VisibilityPeriod()
    {
        return $this->getConfigValue(self::XML_PATH_X3_VISIBILITY_PERIOD);
    }

    /**
     * @return mixed
     */
    public function getMagentoVisibilityPeriod()
    {
        return $this->getConfigValue(self::XML_PATH_MAGENTO_VISIBILITY_PERIOD);
    }

    /**
     * @return mixed
     */
    public function getOrderLockPeriod()
    {
        return $this->getConfigValue(self::XML_PATH_ORDER_LOCK_PERIOD);
    }

    /**
     * @return mixed
     */
    public function getOrderLockMessage()
    {
        return $this->getConfigValue(self::XML_PATH_ORDER_LOCK_MESSAGE);
    }

    /**
     * @return mixed
     */
    public function getIsSubscriptionPeriodAllowed()
    {
        return $this->getConfigValue(self::XML_PATH_SUBSCRIPTION_PERIOD_ENABLE);
    }

    /**
     * @return array|null
     */
    public function getIsSubscriptionIntervals(): ?array
    {
        $intervals = $this->getConfigValue(self::XML_PATH_SUBSCRIPTION_PERIOD_INTERVALS);
        if($intervals == '' || $intervals == null)
            return null;

        $serializeData = $this->serialize->unserialize($intervals);
        $intervalsArray = array();
        foreach($serializeData as $key => $row)
        {
            $intervalsArray[] = [
                "Type" => $row['interval_type'],
                "Number" => $row['interval_number'],
                "Label" => $row['interval_label']
            ];
        }
        return $intervalsArray;
    }
}
