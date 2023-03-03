<?php

namespace Pixafy\Subscription\Model;

use Magento\Framework\Api\SearchResults;
use Pixafy\Subscription\Api\Data\SubscriptionSearchResultsInterface;

/**
 * Subscription entity search results implementation.
 */
class SubscriptionSearchResults extends SearchResults implements SubscriptionSearchResultsInterface
{
    /**
     * @inheritDoc
     */
    public function setItems(array $items) : SubscriptionSearchResultsInterface
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
