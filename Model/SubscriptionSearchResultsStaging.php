<?php

namespace Pixafy\Subscription\Model;

use Magento\Framework\Api\SearchResults;
use Pixafy\Subscription\Api\Data\SubscriptionSearchResultsStagingInterface;

/**
 * Subscription entity search results implementation.
 */
class SubscriptionSearchResultsStaging extends SearchResults implements SubscriptionSearchResultsStagingInterface
{
    /**
     * @inheritDoc
     */
    public function setItems(array $items) : SubscriptionSearchResultsStagingInterface
    {
        return parent::setItems($items);
    }

    /**
     * @inheritDoc
     */
    public function getItems() : array
    {
        return parent::getItems();
    }
}
