<?php

namespace Pixafy\Subscription\Model;

use Magento\Framework\Api\SearchResults;
use Pixafy\Subscription\Api\Data\SubscriptionSearchResultsItemsInterface;

/**
 * Subscription entity search results implementation.
 */
class SubscriptionSearchResultsItems extends SearchResults implements SubscriptionSearchResultsItemsInterface
{
    /**
     * @inheritDoc
     */
    public function setItems(array $items) : SubscriptionSearchResultsItemsInterface
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
