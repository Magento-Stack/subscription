<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Cron\PixafySubscription;

use Psr\Log\LoggerInterface;
use Pixafy\Subscription\Model\ResourceModel\Subscription\CollectionFactory;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Pixafy\Subscription\Model\ResourceModel\SubscriptionOrderSchedule\CollectionFactory as OrderScheduleCollectionFactory;
use Pixafy\Subscription\Api\SubscriptionRepositoryInterface;
use Pixafy\Subscription\Api\SubscriptionOrderScheduleRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder ;
use Magento\Framework\Api\FilterBuilder ;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Pixafy\Subscription\Helper\Config;
use Pixafy\Subscription\Model\SubscriptionOrderScheduleFactory;

/**
 * Post Creation Cron
 */
class PostCreationCron
{
    private $logger;
    private TimezoneInterface $timezone;
    private SubscriptionRepositoryInterface $subscriptionInterface;
    private SearchCriteriaBuilder $searchCriteriaBuilder;
    private FilterBuilder $filterBuilder;
    private FilterGroupBuilder $filterGroupBuilder;
    private SubscriptionOrderScheduleRepositoryInterface $subscriptionOrderScheduleRepositoryInterface;
    private Config $configHelper;
    private SubscriptionOrderScheduleFactory $orderScheduleFactory;

    /**
     * @param LoggerInterface $logger
     * @param TimezoneInterface $timezone
     * @param SubscriptionRepositoryInterface $subscriptionInterface
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param FilterBuilder $filterBuilder
     * @param FilterGroupBuilder $filterGroupBuilder
     * @param SubscriptionOrderScheduleRepositoryInterface $subscriptionOrderScheduleRepositoryInterface
     * @param Config $configHelper
     * @param SubscriptionOrderScheduleFactory $orderScheduleFactory
     */
    public function __construct(
        LoggerInterface $logger,
        TimezoneInterface $timezone,
        SubscriptionRepositoryInterface $subscriptionInterface,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        FilterGroupBuilder $filterGroupBuilder,
        SubscriptionOrderScheduleRepositoryInterface $subscriptionOrderScheduleRepositoryInterface,
        Config $configHelper,
        SubscriptionOrderScheduleFactory $orderScheduleFactory
    ) {
        $this->timezone = $timezone;
        $this->logger = $logger;
        $this->subscriptionInterface = $subscriptionInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->filterGroupBuilder = $filterGroupBuilder;
        $this->subscriptionOrderScheduleRepositoryInterface = $subscriptionOrderScheduleRepositoryInterface;
        $this->configHelper = $configHelper;
        $this->orderScheduleFactory = $orderScheduleFactory;
    }

    /**
     * @return void
     */
    public function execute() {
        $this->logger->info('Pixafy Subscription: Post Creation Cron Start...');
        $currentTime = $this->timezone->date()->format('Y-m-d');
        $currentDate = strtotime($this->timezone->date()->format('Y-m-d'));

        $x3VisibilityPeriod = $this->configHelper->getX3VisibilityPeriod();

        if(!$x3VisibilityPeriod) {
            $x3VisibilityPeriod = 0;
        }
        $subscriptionItems = $this->getValidSubscriptions();
        $this->logger->info('Pixafy Subscription :' .count($subscriptionItems). 'Record Found For Subscriptions');

        foreach ($subscriptionItems as $subscriptionItem) {
            $subscriptionId = $subscriptionItem->getId();
            $intervalInDays = $subscriptionItem->getSubscriptionIntervalNumber();

            $orderScheduleItems = $this->getOrderScheduleRecords($subscriptionId, $currentTime);
            $this->logger->info('Pixafy Subscription :' .count($orderScheduleItems). 'Record Found For subscription_order_schedule table');

            /** @var \Pixafy\Subscription\Api\Data\SubscriptionOrderScheduleInterface $mostFurtherRecored */
            $mostFurtherRecored = last($orderScheduleItems);
            $this->addNewSubscriptionRecords($mostFurtherRecored,$currentDate,$intervalInDays,$x3VisibilityPeriod, $subscriptionId,$subscriptionItem);
            $this->logger->info('Pixafy Subscription: Cron Ended...');
        }
    }

    /**
     * @return \Pixafy\Subscription\Api\Data\SubscriptionInterface[]
     */
    private function getValidSubscriptions(): array
    {
        //Load records from pixafy_subscription table where enable field is pending
        $filterEnable[] = $this->filterBuilder->setField('enable')->setConditionType('eq')->setValue(2)->create();
        $search_criteria_subscription = $this->searchCriteriaBuilder->addFilters($filterEnable)->create();
        return $this->subscriptionInterface->getList($search_criteria_subscription)->getItems();
    }

    /**
     * @param $subscriptionId
     * @param $currentTime
     * @return \Pixafy\Subscription\Api\Data\SubscriptionOrderScheduleInterface[]
     */
    private function getOrderScheduleRecords($subscriptionId, $currentTime): array
    {
        //Load records from pixafy_subscription_order_schedule where record is active and expected date is greater than the current date.
        $isValidFilter = $this->filterBuilder->setField('is_valid')->setConditionType('eq')->setValue('1')->create();
        $expectedDateFilter = $this->filterBuilder->setField('expected_delivery_date')->setConditionType('gt')->setValue($currentTime)->create();
        $subscriptionIdFilter = $this->filterBuilder->setField('subscription_id')->setConditionType('eq')->setValue($subscriptionId)->create();
        $filterIsValid = $this->filterGroupBuilder->addFilter($isValidFilter)->create();
        $filterExpectedDate = $this->filterGroupBuilder->addFilter($expectedDateFilter)->create();
        $filterSubscriptionId = $this->filterGroupBuilder->addFilter($subscriptionIdFilter)->create();
        $search_criteria_subscription_order = $this->searchCriteriaBuilder->setFilterGroups([$filterIsValid,$filterExpectedDate,$filterSubscriptionId])->create();
        return $this->subscriptionOrderScheduleRepositoryInterface->getList($search_criteria_subscription_order)->getItems();
    }

    /**
     * @param $mostFurtherRecored
     * @param $currentDate
     * @param $intervalInDays
     * @param $x3VisibilityPeriod
     * @param $subscriptionId
     * @param $subscriptionItem
     * @return void
     */
    private function addNewSubscriptionRecords ($mostFurtherRecored,$currentDate,$intervalInDays,$x3VisibilityPeriod, $subscriptionId,$subscriptionItem) {
        $expectedDates = [];
        $expectedDeliveryDate = strtotime($mostFurtherRecored->getExpectedDeliveryDate());
        $daysToNextDelivery = abs($expectedDeliveryDate - $currentDate);
        $daysToNextDelivery = round($daysToNextDelivery / (60 * 60 * 24));

        $currentInterval = $daysToNextDelivery + $intervalInDays;
        $daysCounter = 1;

        //check if day to next delivery date + interval days is less then the visibility period
        while ($currentInterval < $x3VisibilityPeriod) {
            $days = $intervalInDays * $daysCounter;
            $currentExpectedDeliveryDate = strtotime($mostFurtherRecored->getExpectedDeliveryDate() . " + " . $days . " day");
            $nextDeliveryDate = date('Y-m-d', $currentExpectedDeliveryDate);
            $orderScheduleFactory = $this->orderScheduleFactory->create();
            $orderScheduleFactory->setIsValid(1);
            $orderScheduleFactory->setIsPosted(0);
            $orderScheduleFactory->seteExpectedDeliveryDate($nextDeliveryDate);
            $orderScheduleFactory->setSubscriptionId((int) $subscriptionId);
            $this->subscriptionOrderScheduleRepositoryInterface->save($orderScheduleFactory);
            $currentInterval += $intervalInDays;
            ++$daysCounter;
            $expectedDates[] = $nextDeliveryDate;
            $this->logger->info('Pixafy Subscription : New Record is created in pixafy_order_schedule table');
        }
        if (isset($expectedDates[0])) {
            if ($subscriptionItem->getNextShipDate() != $expectedDates[0]) {
                $subscriptionItem->setNextShipDate($expectedDates[0]);
                $this->subscriptionInterface->save($subscriptionItem);
                $this->logger->info('Pixafy Subscription : Next Ship Date Is Updated in pixafy_subscription table');
            }
        }
    }
}
