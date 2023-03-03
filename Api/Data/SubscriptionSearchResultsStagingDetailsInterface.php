<?php

namespace Pixafy\Subscription\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Subscription entity search result.
 */
interface SubscriptionSearchResultsStagingDetailsInterface extends SearchResultsInterface
{
    /**
     * Set items.
     *
     * @param \Pixafy\Subscription\Api\Data\SubscriptionStagingDetailsInterface[] $items
     *
     * @return SubscriptionSearchResultsStagingDetailsInterface
     */
    public function setItems(array $items) : SubscriptionSearchResultsStagingDetailsInterface;

    /**
     * Get items.
     *
     * @return \Pixafy\Subscription\Api\Data\SubscriptionStagingDetailsInterface[]
     */
    public function getItems() : array;
}
