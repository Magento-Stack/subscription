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
use Pixafy\Subscription\Api\Data\SubscriptionInterface;
use Pixafy\Subscription\Model\Subscription;
use Pixafy\Subscription\Api\Data\SubscriptionSearchResultsInterface;

interface SubscriptionRepositoryInterface
{
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SubscriptionSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria) : SubscriptionSearchResultsInterface;

    /**
     * @param int $id
     * @return SubscriptionInterface
     */
    public function get(int $id);

    /**
     * @param SubscriptionInterface $subscription
     * @return SubscriptionInterface
     */
    public function save(Subscription $subscription);
}
