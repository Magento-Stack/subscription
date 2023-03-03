<?php

namespace Pixafy\Subscription\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Subscription entity search result.
 */
interface SubscriptionSearchResultsItemsInterface extends SearchResultsInterface
{
    /**
     * Set items.
     *
     * @param \Pixafy\Subscription\Api\Data\SubscriptionItemInterface[] $items
     *
     * @return SubscriptionSearchResultsItemsInterface
     */
    public function setItems(array $items) : SubscriptionSearchResultsItemsInterface;

    /**
     * Get items.
     *
     * @return \Pixafy\Subscription\Api\Data\SubscriptionItemInterface[]
     */
    public function getItems() : array;
}
