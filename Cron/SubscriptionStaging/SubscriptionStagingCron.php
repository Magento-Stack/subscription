<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Cron\SubscriptionStaging;

use Psr\Log\LoggerInterface;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Pixafy\Subscription\Model\SubscriptionFactory;
use Pixafy\Subscription\Helper\Config;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\FilterBuilder;
use Pixafy\Subscription\Api\SubscriptionItemRepositoryInterface;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Pixafy\Subscription\Api\SubscriptionOrderScheduleRepositoryInterface;
use Pixafy\Subscription\Api\SubscriptionStagingRepositoryInterface;
use Pixafy\Subscription\Api\SubscriptionStagingDetailsRepositoryInterface;
use Pixafy\Subscription\Api\SubscriptionRepositoryInterface;

/**
 *
 */
class SubscriptionStagingCron
{
    private LoggerInterface $logger;
    private TimezoneInterface $timezone;
    private SubscriptionFactory $subscriptionFactory;
    private Config $helper;
    private SearchCriteriaBuilder $searchCriteriaBuilder;
    private FilterBuilder $filterBuilder;
    private SubscriptionItemRepositoryInterface $subscriptionItemRepositoryInterface;
    private FilterGroupBuilder $filterGroupBuilder;
    private SubscriptionOrderScheduleRepositoryInterface $subscriptionOrderScheduleRepositoryInterface;
    private SubscriptionStagingRepositoryInterface $subscriptionStagingRepositoryInterface;
    private SubscriptionStagingDetailsRepositoryInterface $subscriptionStagingDetailsRepositoryInterface;
    private SubscriptionRepositoryInterface $subscriptionRepositoryInterface;


    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param LoggerInterface $logger
     * @param TimezoneInterface $timezone
     * @param SubscriptionFactory $subscriptionFactory
     * @param Config $helper
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param FilterBuilder $filterBuilder
     * @param SubscriptionItemRepositoryInterface $subscriptionItemRepositoryInterface
     * @param FilterGroupBuilder $filterGroupBuilder
     * @param SubscriptionOrderScheduleRepositoryInterface $subscriptionOrderScheduleRepositoryInterface
     * @param SubscriptionStagingRepositoryInterface $subscriptionStagingRepositoryInterface
     * @param SubscriptionStagingDetailsRepositoryInterface $subscriptionStagingDetailsRepositoryInterface
     * @param SubscriptionRepositoryInterface $subscriptionRepositoryInterface
     */
    public function __construct(
        LoggerInterface                     $logger,
        TimezoneInterface                   $timezone,
        SubscriptionFactory                 $subscriptionFactory,
        Config                              $helper,
        SearchCriteriaBuilder               $searchCriteriaBuilder,
        FilterBuilder                       $filterBuilder,
        SubscriptionItemRepositoryInterface $subscriptionItemRepositoryInterface,
        FilterGroupBuilder                  $filterGroupBuilder,
        SubscriptionOrderScheduleRepositoryInterface $subscriptionOrderScheduleRepositoryInterface,
        SubscriptionStagingRepositoryInterface $subscriptionStagingRepositoryInterface,
        SubscriptionStagingDetailsRepositoryInterface $subscriptionStagingDetailsRepositoryInterface,
        SubscriptionRepositoryInterface $subscriptionRepositoryInterface
    ) {
        $this->logger = $logger;
        $this->timezone = $timezone;
        $this->subscriptionFactory = $subscriptionFactory;
        $this->helper = $helper;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->subscriptionItemRepositoryInterface = $subscriptionItemRepositoryInterface;
        $this->filterGroupBuilder = $filterGroupBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->subscriptionOrderScheduleRepositoryInterface = $subscriptionOrderScheduleRepositoryInterface;
        $this->subscriptionStagingRepositoryInterface = $subscriptionStagingRepositoryInterface;
        $this->subscriptionStagingDetailsRepositoryInterface = $subscriptionStagingDetailsRepositoryInterface;
        $this->subscriptionRepositoryInterface = $subscriptionRepositoryInterface;
    }
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $this->logger->info('Pixafy Subscription CRON Started.');

        $currentDate = $this->timezone->date()->format('Y-m-d');

        //get filtered collection of subscribed staging items
        $isApprovedFilter = $this->filterBuilder->setField('is_approved')->setConditionType('eq')->setValue('1')->create();
        $isExecutedFilter =  $this->filterBuilder->setField('is_executed')->setConditionType('eq')->setValue('0')->create();
        $dateScheduledFilter =  $this->filterBuilder->setField('date_scheduled')->setConditionType('like')->setValue($currentDate)->create();

        $filterIsApproved = $this->filterGroupBuilder->addFilter($isApprovedFilter)->create();
        $filterIsExecuted = $this->filterGroupBuilder->addFilter($isExecutedFilter)->create();
        $filterDateScheduled = $this->filterGroupBuilder->addFilter($dateScheduledFilter)->create();
        $search_criteria = $this->searchCriteriaBuilder->setFilterGroups([$filterIsApproved,$filterIsExecuted,$filterDateScheduled])->create();

        $searchResultSubscriptionItems = $this->subscriptionStagingRepositoryInterface->getList($search_criteria);
        $subscriptionStagingItems = $searchResultSubscriptionItems->getItems();

        $this->logger->info('Pixafy Subscription: ' .count($subscriptionStagingItems)  . ' Items found in pixafy_subscription_staging table.');

        foreach ($subscriptionStagingItems as $subscriptionStagingItem) {
            $subscriptionId = $subscriptionStagingItem->getSubscriptionId();

            //filter staging details item
            $subscriptionStagingDetailsFilter[] = $this->filterBuilder->setField('subscription_staging_id')
                ->setConditionType('eq')
                ->setValue($subscriptionStagingItem->getSubscriptionStagingId())
                ->create();
            $search_criteria = $this->searchCriteriaBuilder->addFilters($subscriptionStagingDetailsFilter)->create();

            $stagingDetailsItems = $this->subscriptionStagingDetailsRepositoryInterface->getList($search_criteria);
            $stagingDetailsItems = $stagingDetailsItems->getItems();

            $this->logger->info('Pixafy Subscription: ' .count($stagingDetailsItems)  . ' Items found in pixafy_subscription_staging_details table.');

            foreach ($stagingDetailsItems as $detailsItem) {
                //load the all the values of current details item
                $fieldName = $detailsItem->getFieldName();
                $oldValue = $detailsItem->getOldValue();
                $newValue = $detailsItem->getNewValue();
                $notes = $detailsItem->getNotes();
                $productId = $detailsItem->getProductId();
                if ($productId) {
                    $this->saveSubscriptionItemData($productId, $newValue, $subscriptionId);
                    $this->orderScheduleData($subscriptionId);
                    $subscriptionStagingItem->setIsExecuted(1);
                    $this->subscriptionStagingRepositoryInterface->save($subscriptionStagingItem);
                } else {
                    $this->saveSubscriptionData($fieldName, $newValue, $subscriptionId);
                    $this->orderScheduleData($subscriptionId);
                    $subscriptionStagingItem->setIsExecuted(1);
                    $this->subscriptionStagingRepositoryInterface->save($subscriptionStagingItem);
                }
                $this->logger->info('Pixafy Subscription: ' .$detailsItem->getSubscriptionStagingDetailsId()  . ' Item ID of pixafy_subscription_staging_details table has been processed.');
            }
        }
    }

    /**
     * @param $productId
     * @param $fieldName
     * @param $newValue
     * @param $subscriptionID
     * @return void
     *
     * update the qty field value in subscription items
     */
    private function saveSubscriptionItemData($productId, $newValue, $subscriptionID)
    {
        try {
            $productIdFilter = $this->filterBuilder->setField('product_id')->setConditionType('eq')->setValue($productId)->create();
            $subscriptionIDFilter =  $this->filterBuilder->setField('subscription_id')->setConditionType('eq')->setValue($subscriptionID)->create();

            $filterProductId = $this->filterGroupBuilder->addFilter($productIdFilter)->create();
            $filterSubscriptionId = $this->filterGroupBuilder->addFilter($subscriptionIDFilter)->create();

            $search_criteria = $this->searchCriteriaBuilder->setFilterGroups([$filterProductId,$filterSubscriptionId])->create();

            $searchResultSubscriptionItems = $this->subscriptionItemRepositoryInterface->getList($search_criteria);
            $items = $searchResultSubscriptionItems->getItems();

            $this->logger->info('Pixafy Subscription: ' .count($items)  . ' Items found in pixafy_subscription_items table.');

            if (!count($items)) {
                $this->logger->alert(__('Pixafy Subscription: No Item Found to Update Against Subscription ID: ' . $subscriptionID));
            }

            /** @var \Pixafy\Subscription\Api\Data\SubscriptionItemInterface $item */
            $item = current($items);
            $newValue = (int)$newValue;
            $item->setQty($newValue);
            $this->subscriptionItemRepositoryInterface->save($item);
            $this->logger->info('Pixafy Subscription: '. $item->getId()  . ' Item is updated.');
        } catch (\Exception $e) {
            $this->logger->error(__('Pixafy Subscription: Something went wrong while updating data in pixafy_subscription_item table: ' . $e->getMessage()));
        }
    }

    /**
     * @param $fieldName
     * @param $newValue
     * @param $subscriptionID
     * @return void
     *
     * update the values in subscription table
     */
    public function saveSubscriptionData($fieldName, $newValue, $subscriptionID)
    {
        try {
            $subscription = $this->subscriptionFactory->create()->load($subscriptionID);
            $subscription->setData($fieldName, $newValue);
            $subscription->setData('x3_order_rebuild_flag', 1);
            $this->subscriptionRepositoryInterface->save($subscription);
            $this->logger->info('Pixafy Subscription: Subscription '.$subscriptionID.' Item is updated.');
        } catch (\Exception $e) {
            $this->logger->error(__('Pixafy Subscription: Something went wrong while updating pixafy_subscription table: ' . $e->getMessage()));
        }
    }

    /**
     * @param $subscriptionId
     * @return void
     *
     * update value is valid into the subscription order table
     */
    private function orderScheduleData($subscriptionId)
    {
        try {
            $orderLockPeriod = $this->helper->getOrderLockPeriod();
            if(!$orderLockPeriod) {
                $orderLockPeriod = 0;
            }

            $subscriptionOrderFilter[] = $this->filterBuilder->setField('subscription_id')->setConditionType('eq')
                ->setValue($subscriptionId)
                ->create();
            $search_criteria = $this->searchCriteriaBuilder->addFilters($subscriptionOrderFilter)->create();
            $orderScheduleCollection = $this->subscriptionOrderScheduleRepositoryInterface->getList($search_criteria);
            $orderScheduleItems = $orderScheduleCollection->getItems();
            $this->logger->info('Pixafy Subscription:' . count($orderScheduleItems)  . ' Items found in pixafy_subscription_order_schedule table.');

            foreach ($orderScheduleItems as $item) {
                $expectedDeliveryDate = strtotime($item->getExpectedDeliveryDate());
                $currentDate = strtotime($this->timezone->date()->format('Y-m-d'));
                $daysToNextDelivery = abs($expectedDeliveryDate - $currentDate);
                $daysToNextDelivery = round($daysToNextDelivery / (60 * 60 * 24));
                if ($daysToNextDelivery > $orderLockPeriod) {
                    $item->setIsValid(0);
                    $this->subscriptionOrderScheduleRepositoryInterface->save($item);
                    $this->logger->info($item->getScheduleId()  . ' Item is updated.');
                } else {
                    $this->logger->alert('Pixafy Subscription: For order ID: ' . $item->getScheduleId() . ' Order Lock Period is Greater Than Next Delivery Date.');
                }
            }
        } catch (\Exception $e) {
            $this->logger->error(__('Pixafy Subscription:  Order Schedule Update Error: ' . $e->getMessage()));
        }
    }
}
