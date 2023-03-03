<?php

namespace Pixafy\Subscription\Model;

use Magento\Framework\Api\SearchResults;
use Pixafy\Subscription\Api\Data\SubscriptionSearchResultsOrderScheduleInterface;

/**
 * Subscription entity search results implementation.
 */
class SubscriptionSearchResultsOrderSchedule extends SearchResults implements SubscriptionSearchResultsOrderScheduleInterface
{
    /**
     * @inheritDoc
     */
    public function setItems(array $items) : SubscriptionSearchResultsOrderScheduleInterface
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
