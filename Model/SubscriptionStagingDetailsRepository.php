<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Model;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Pixafy\Subscription\Api\Data\SubscriptionStagingDetailsInterface;
use Pixafy\Subscription\Api\Data\SubscriptionSearchResultsStagingDetailsInterface as SubscriptionSearchResultsInterface;
use Pixafy\Subscription\Api\Data\SubscriptionSearchResultsStagingDetailsInterfaceFactory as SubscriptionSearchResultsInterfaceFactory;
use Pixafy\Subscription\Model\ResourceModel\SubscriptionStagingDetails\Collection;
use Pixafy\Subscription\Model\ResourceModel\SubscriptionStagingDetails\CollectionFactory;
use Pixafy\Subscription\Model\ResourceModel\SubscriptionStagingDetails as SubscriptionResource;
use Pixafy\Subscription\Api\SubscriptionStagingDetailsRepositoryInterface;
use Psr\Log\LoggerInterface;
use Pixafy\Subscription\Model\SubscriptionStagingDetails;
use Pixafy\Subscription\Model\SubscriptionStagingDetailsFactory;

class SubscriptionStagingDetailsRepository implements SubscriptionStagingDetailsRepositoryInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var SubscriptionStagingDetailsFactory
     */
    private $modelFactory;

    /**
     * @var SubscriptionResource
     */
    private $resource;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var DataObjectProcessor
     */
    private $dataProcessor;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var SubscriptionSearchResultsInterfaceFactory
     */
    private $searchResultsInterfaceFactory;

    /**
     * @param LoggerInterface $logger
     * @param SubscriptionStagingDetailsFactory $modelFactory
     * @param SubscriptionResource $resource
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param CollectionFactory $collectionFactory
     * @param DataObjectProcessor $dataProcessor
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SubscriptionSearchResultsInterfaceFactory $searchResultsInterfaceFactory
     */
    public function __construct(
        LoggerInterface $logger,
        SubscriptionStagingDetailsFactory $modelFactory,
        SubscriptionResource $resource,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        CollectionFactory $collectionFactory,
        DataObjectProcessor $dataProcessor,
        CollectionProcessorInterface $collectionProcessor,
        SubscriptionSearchResultsInterfaceFactory $searchResultsInterfaceFactory
    ) {
        $this->logger = $logger;
        $this->modelFactory = $modelFactory;
        $this->resource = $resource;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->collectionFactory = $collectionFactory;
        $this->dataProcessor = $dataProcessor;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsInterfaceFactory = $searchResultsInterfaceFactory;
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria) : SubscriptionSearchResultsInterface
    {
        try {
            $collection = $this->collectionFactory->create();

            $this->addFiltersToCollection($searchCriteria, $collection);
            $this->addSortOrdersToCollection($searchCriteria, $collection);
            $this->addPagingToCollection($searchCriteria, $collection);

            $collection->load();

            return $this->buildSearchResult($searchCriteria, $collection);

        } catch (\Exception $exception) {
            throw new NoSuchEntityException(
                __('Something went wrong while getting records: ' . $exception->getMessage())
            );
        }
    }
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     * @return void
     */
    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     * @return void
     */
    private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ((array)$searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     * @return void
     */
    private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     * @return SubscriptionSearchResultsInterface
     */
    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $searchResults = $this->searchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function get(int $id)
    {
        /** @var SubscriptionStagingDetails $model */
        $model = $this->modelFactory->create();
        $this->resource->load($model, $id);
        return $model;
    }

    /**
     * @inheritDoc
     */
    public function save(SubscriptionStagingDetails $subscription)
    {
        try {
            $this->modelFactory->create()->getResource()->save($subscription);
            return $subscription;
        } catch (\Exception $exception) {
            throw new NoSuchEntityException(__('Unable to save object'));
        }
    }

    /**
     * @inheritDoc
     */
    public function delete(SubscriptionStagingDetails $subscription)
    {
        try {
            $this->modelFactory->create()->getResource()->delete($subscription);
            return $subscription;
        } catch (\Exception $exception) {
            throw new NoSuchEntityException(__('Unable to save object'));
        }
    }
}
