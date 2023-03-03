<?php

namespace Pixafy\Subscription\Helper;

use Exception;
use Magento\Checkout\Model\Session;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Quote\Model\QuoteRepository;

/**
 * Class Helper
 * @package Pixafy\Subscription\Helper
 */
class Helper
{
    /**
     * @var Config
     */
    protected Config $config;

    /**
     * @var Session
     */
    protected Session $checkoutSession;

    /**
     * @var Json
     */
    protected Json $serialize;

    /**
     * @var QuoteRepository
     */
    protected QuoteRepository $quoteRepository;

    /**
     * @param Config $config
     * @param Session $checkoutSession
     * @param Json $serialize
     * @param QuoteRepository $quoteRepository
     */
    public function __construct(
        Config          $config,
        Session         $checkoutSession,
        Json            $serialize,
        QuoteRepository $quoteRepository)
    {
        $this->config = $config;
        $this->checkoutSession = $checkoutSession;
        $this->serialize = $serialize;
        $this->quoteRepository = $quoteRepository;

    }

    /**
     * @return bool
     * @throws Exception
     */
    public function isVisible(): bool
    {
        try {
            $isEnabled = $this->config->isSubscriptionEnable();
            $quote = $this->checkoutSession->getQuote();
            if ($quote->getId() && $quote->getIsOnDemand() && $isEnabled) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception(__($e->getMessage()));
        }
    }

    /**
     * @return string
     * @throws Exception
     */
    public function isRecurring(): string
    {
        try {
            $quote = $this->checkoutSession->getQuote();
            if ($quote->getId()) {
                if ($quote->getIsSubscription() == 1) {
                    return "block";
                }
            }
            return "none";
        } catch (Exception $e) {
            throw new Exception(__($e->getMessage()));
        }
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function isSingle(): bool
    {
        try {
            $quote = $this->checkoutSession->getQuote();
            if ($quote->getId()) {
                if ($quote->getIsSubscription() == 0) {
                    return true;
                }
            }
            return false;
        } catch (Exception $e) {
            throw new Exception(__($e->getMessage()));
        }
    }

    /**
     * @return int|string|null
     * @throws Exception
     */
    public function getSelectedIntervalValue()
    {
        try {
            $quote = $this->checkoutSession->getQuote();
            if ($quote->getId()) {
                $type = $quote->getSubscriptionIntervalType();
                $number = $quote->getSubscriptionIntervalNumber();
                $label = $quote->getSubscriptionIntervalLabel();
                $intervals = $this->config->getConfigValue(Config::XML_PATH_SUBSCRIPTION_PERIOD_INTERVALS);
                if ($intervals == '' || $intervals == null)
                    return null;
                $serializeData = $this->serialize->unserialize($intervals);
                foreach ($serializeData as $key => $row) {
                    if ($type == $row['interval_type'] &&
                        $number == $row['interval_number'] &&
                        $label == $row['interval_label']) {
                        return $key;
                    }
                }
            }
            return null;
        } catch (Exception $e) {
            throw new Exception(__($e->getMessage()));
        }
    }

    /**
     * @return array|null
     * @throws Exception
     */
    public function getSubscriptionIntervals(): ?array
    {
        try {
            $intervals = $this->config->getConfigValue(Config::XML_PATH_SUBSCRIPTION_PERIOD_INTERVALS);
            if ($intervals == '' || $intervals == null)
                return null;

            $serializeData = $this->serialize->unserialize($intervals);
            $intervalsArray = array();
            $intervalsArray[] = [
                "value" => '',
                "label" => 'Please Select'
            ];
            foreach ($serializeData as $key => $row) {
                $intervalsArray[] = [
                    "value" => $key,
                    "label" => $row['interval_label']
                ];
            }
            return $intervalsArray;
        } catch (Exception $e) {
            throw new Exception(__($e->getMessage()));
        }
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getQuoteSubscriptionValue(): string
    {
        try {
            $quote = $this->checkoutSession->getQuote();
            if ($quote->getId()) {
                if ($quote->getIsSubscription() == 1) {
                    return "recurring";
                }
            }
            return "single";
        } catch (Exception $e) {
            throw new Exception(__($e->getMessage()));
        }
    }
}
