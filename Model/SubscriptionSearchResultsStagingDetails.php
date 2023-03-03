<?php

namespace Pixafy\Subscription\Model;

use Magento\Framework\Api\SearchResults;
use Pixafy\Subscription\Api\Data\SubscriptionSearchResultsStagingDetailsInterface;

/**
 * Subscription entity search results implementation.
 */
class SubscriptionSearchResultsStagingDetails extends SearchResults implements SubscriptionSearchResultsStagingDetailsInterface
{
    /**
     * @inheritDoc
     */
    public function setItems(array $items) : SubscriptionSearchResultsStagingDetailsInterface
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
