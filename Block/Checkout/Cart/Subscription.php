<?php
declare(strict_types=1);

namespace Pixafy\Subscription\Block\Checkout\Cart;

use Exception;
use Magento\Framework\View\Element\Template\Context;
use Pixafy\Subscription\Helper\Helper;

/**
 * class Subscription
 * @package Pixafy\Subscription\Block\Checkout\Cart
 */
class Subscription extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Helper
     */
    protected Helper $helper;

    /**
     * @param Context $context
     * @param Helper $helper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Helper  $helper,
        array   $data = [])
    {
        $this->helper = $helper;
        parent::__construct($context, $data);
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function isVisible(): bool
    {
        return $this->helper->isVisible();
    }

    /**
     * @return string
     * @throws Exception
     */
    public function isRecurring(): string
    {
        return $this->helper->isRecurring();
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function isSingle(): bool
    {
        return $this->helper->isSingle();
    }

    /**
     * @return int|string|null
     * @throws Exception
     */
    public function getSelectedIntervalValue()
    {
        return $this->helper->getSelectedIntervalValue();
    }

    /**
     * @return array|null
     * @throws Exception
     */
    public function getSubscriptionIntervals(): ?array
    {
        return $this->helper->getSubscriptionIntervals();
    }
}
