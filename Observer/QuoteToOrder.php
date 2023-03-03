<?php

namespace Pixafy\Subscription\Observer;

use Magento\Framework\Event\ObserverInterface;
use Pixafy\Subscription\Api\SubscriptionRepositoryInterface;
use Pixafy\Subscription\Model\SubscriptionFactory;

/**
 * class QuoteToOrder
 */
class QuoteToOrder implements ObserverInterface
{
    private SubscriptionRepositoryInterface $subscriptionRepositoryInterface;
    private SubscriptionFactory $subscriptionFactory;


    /**
     * @param SubscriptionRepositoryInterface $subscriptionRepositoryInterface
     * @param SubscriptionFactory $subscriptionFactory
     */
    public function __construct (
        SubscriptionRepositoryInterface $subscriptionRepositoryInterface,
        SubscriptionFactory $subscriptionFactory
    ) {
        $this->subscriptionRepositoryInterface = $subscriptionRepositoryInterface;
        $this->subscriptionFactory = $subscriptionFactory;
    }


    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this|void|null
     * @throws \Exception
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /* @var \Magento\Sales\Model\Order $order */
        $order = $observer->getEvent()->getData('order');
        /* @var \Magento\Quote\Model\Quote $quote */
        $quote = $observer->getEvent()->getData('quote');

        if (!$quote) {
            return null;
        }

        $note = $quote->getData('notes');

        if($quote->getData('is_subscription') == 0) {
            $order->setData('notes',$quote->getData('notes'));
            $order->save();
        } else if ($quote->getData('is_subscription') == 1) {
            $subscriptionFactory = $this->subscriptionFactory->create();
            $subscriptionFactory->setNotes($quote->getData('notes'));
            $this->subscriptionRepositoryInterface->save($subscriptionFactory);
        } else {
            return null;
        }

        return $this;
    }
}
