<?php

namespace Pixafy\Subscription\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Subscription entity search result.
 */
interface SubscriptionSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Set items.
     *
     * @param \Pixafy\Subscription\Api\Data\SubscriptionInterface[] $items
     *
     * @return SubscriptionSearchResultsInterface
     */
    public function setItems(array $items) : SubscriptionSearchResultsInterface;

    /**
     * Get items.
     *
     * @return \Pixafy\Subscription\Api\Data\SubscriptionInterface[]
     */
    public function getItems() : array;
}
