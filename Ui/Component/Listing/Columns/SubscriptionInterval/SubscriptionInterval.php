<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Ui\Component\Listing\Columns\SubscriptionInterval;

use Pixafy\Subscription\Helper\Config;

// Getting data from configurations and show into drop down
class SubscriptionInterval implements \Magento\Framework\Option\ArrayInterface
{
    private $options;
    private Config $subscriptionHelper;

    /**
     * @param Config $subscriptionHelper
     */
    public function __construct(
        Config $subscriptionHelper
    ) {
        $this->subscriptionHelper = $subscriptionHelper;
    }

    /**
     * @return array|null
     */
    public function toOptionArray()
    {
        //TODO: Need to update the logic
        $subscriptionIntervals = $this->subscriptionHelper->getIsSubscriptionIntervals();
        if (!$subscriptionIntervals) {
            return null;
        }

        foreach ($subscriptionIntervals as $id => $state) {
            $this->options[] = [
                'value' => $id,
                'label' => $state['Label']
            ];
        }

        return $this->options;
    }
}
