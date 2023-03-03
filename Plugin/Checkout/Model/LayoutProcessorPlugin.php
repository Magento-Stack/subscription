<?php

namespace Pixafy\Subscription\Plugin\Checkout\Model;

use Exception;
use Magento\Checkout\Block\Checkout\LayoutProcessor;
use Pixafy\Subscription\Helper\Helper;

/**
 *  add subscription radio buttons on checkout
 */
class LayoutProcessorPlugin
{
    /**
     * @var Helper
     */
    protected $helper;

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
     * @param LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     * @throws Exception
     */
    public function afterProcess(
        LayoutProcessor $subject,
        array           $jsLayout
    ): array
    {
        if ($this->helper->isVisible()) {
            $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
            ['payment']['children']['payments-list']['children']['before-place-order']['children']['subscription'] = [
                'component' => 'Pixafy_Subscription/js/view/subscription',
                'dataScope' => 'checkoutcomments',
                'provider' => 'checkoutProvider',
                'visible' => true,
                'sortOrder' => 10,
                'validation' => ['required-entry' => true]
            ];
        }
        return $jsLayout;
    }
}
