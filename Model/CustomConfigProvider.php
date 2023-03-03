<?php

namespace Pixafy\Subscription\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Pixafy\Subscription\Helper\Helper;

/**
 * class CustomConfigProvider
 * @package Pixafy\Subscription\Model
 */
class CustomConfigProvider implements ConfigProviderInterface
{
    /**
     * @var Helper
     */
    protected Helper $helper;

    /**
     * @param Helper $helper
     */
    public function __construct(
        Helper $helper
    )
    {
        $this->helper = $helper;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getConfig(): array
    {
        $config = [];
        $config['subscription_intervals'] = $this->helper->getSubscriptionIntervals();
        $config['is_subscription'] = $this->helper->getQuoteSubscriptionValue();
        $config['selected_interval'] = $this->helper->getSelectedIntervalValue();
        return $config;
    }
}
