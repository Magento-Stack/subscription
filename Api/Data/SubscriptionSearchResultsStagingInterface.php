<?php

namespace Pixafy\Subscription\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Subscription entity search result.
 */
interface SubscriptionSearchResultsStagingInterface extends SearchResultsInterface
{
    /**
     * Set items.
     *
     * @param \Pixafy\Subscription\Api\Data\SubscriptionStagingInterface[] $items
     *
     * @return SubscriptionSearchResultsStagingInterface
     */
    public function setItems(array $items) : SubscriptionSearchResultsStagingInterface;

    /**
     * Get items.
     *
     * @return \Pixafy\Subscription\Api\Data\SubscriptionStagingInterface[]
     */
    public function getItems() : array;
}
