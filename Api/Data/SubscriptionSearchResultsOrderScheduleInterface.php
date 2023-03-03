<?php

namespace Pixafy\Subscription\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Subscription entity search result.
 */
interface SubscriptionSearchResultsOrderScheduleInterface extends SearchResultsInterface
{
    /**
     * Set items.
     *
     * @param \Pixafy\Subscription\Api\Data\SubscriptionOrderScheduleInterface[] $items
     *
     * @return SubscriptionSearchResultsOrderScheduleInterface
     */
    public function setItems(array $items) : SubscriptionSearchResultsOrderScheduleInterface;

    /**
     * Get items.
     *
     * @return \Pixafy\Subscription\Api\Data\SubscriptionOrderScheduleInterface[]
     */
    public function getItems() : array;
}
