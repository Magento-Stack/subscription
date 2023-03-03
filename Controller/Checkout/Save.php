<?php

namespace Pixafy\Subscription\Controller\Checkout;

use Exception;
use Magento\Checkout\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Quote\Model\QuoteRepository;
use Pixafy\Subscription\Helper\Config;

/**
 * class Save
 * @package Pixafy\Subscription\Controller\Checkout
 */
class Save extends Action
{
    /**
     * @var Session
     */
    protected Session $checkoutSession;

    /**
     * @var QuoteRepository
     */
    protected QuoteRepository $quoteRepository;

    /**
     * @var Json
     */
    protected Json $serialize;

    /**
     * @var Config
     */
    protected Config $config;

    /**
     * @param Context $context
     * @param Session $checkoutSession
     * @param QuoteRepository $quoteRepository
     * @param Json $serialize
     * @param Config $config
     */
    public function __construct(
        Context         $context,
        Session         $checkoutSession,
        QuoteRepository $quoteRepository,
        Json            $serialize,
        Config          $config
    )
    {
        $this->checkoutSession = $checkoutSession;
        $this->quoteRepository = $quoteRepository;
        $this->serialize = $serialize;
        $this->config = $config;
        parent::__construct($context);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function execute()
    {
        try {
            $type = $this->getRequest()->getParam('type');

            /** @var int $quoteId */
            $quoteId = $this->checkoutSession->getQuoteId();

            /** @var  \Magento\Quote\Api\Data\CartInterface|\Magento\Quote\Model\Quote $quote */
            $quote = $this->quoteRepository->get($quoteId);

            if ($type == "single") {
                $quote->setIsSubscription(0);
                $quote->setSubscriptionIntervalType(null);
                $quote->setSubscriptionIntervalNumber(null);
                $quote->setSubscriptionIntervalLabel(null);
            } else if ($type == "recurring") {
                $quote->setIsSubscription(1);
                if ($this->getRequest()->getParam('value')) {
                    $selectedInterval = $this->getSubscriptionIntervals($this->getRequest()->getParam('value'));
                    if ($selectedInterval) {
                        $quote->setSubscriptionIntervalType($selectedInterval['Type']);
                        $quote->setSubscriptionIntervalNumber($selectedInterval['Number']);
                        $quote->setSubscriptionIntervalLabel($selectedInterval['Label']);
                    }
                }
            }
            $quote->save();
        } catch (Exception $e) {
            throw new Exception(__($e->getMessage()));
        }
    }

    /**
     * @param $value
     * @return array|null
     * @throws Exception
     */
    public function getSubscriptionIntervals($value): ?array
    {
        try {
            $intervals = $this->config->getConfigValue(Config::XML_PATH_SUBSCRIPTION_PERIOD_INTERVALS);
            if ($intervals == '' || $intervals == null)
                return null;

            $serializeData = $this->serialize->unserialize($intervals);
            $intervalsArray = array();
            foreach ($serializeData as $key => $row) {
                if ($key == $value) {
                    $intervalsArray = [
                        "Type" => $row['interval_type'],
                        "Number" => $row['interval_number'],
                        "Label" => $row['interval_label']
                    ];
                }
            }
            return $intervalsArray;
        } catch (Exception $e) {
            throw new Exception(__($e->getMessage()));
        }
    }
}
