<?php
/**
 * Pixafy_Subscription extension
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category  Pixafy
 * @package   Pixafy_Subscription
 * @copyright Copyright (c) 2022
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */
declare(strict_types=1);

namespace Pixafy\Subscription\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Pixafy\Subscription\Api\Data\SubscriptionStagingInterface;
use Pixafy\Subscription\Model\SubscriptionStaging;
use Pixafy\Subscription\Api\Data\SubscriptionSearchResultsStagingInterface;

interface SubscriptionStagingRepositoryInterface
{
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SubscriptionSearchResultsStagingInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria) : SubscriptionSearchResultsStagingInterface;

    /**
     * @param int $id
     * @return SubscriptionStagingInterface
     */
    public function get(int $id);

    /**
     * @param SubscriptionStagingInterface $subscription
     * @return SubscriptionStagingInterface
     */
    public function save(SubscriptionStaging $subscription);
}
