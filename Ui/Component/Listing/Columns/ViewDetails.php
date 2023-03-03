<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Ui\Component\Listing\Columns;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Pixafy\Subscription\Model\ResourceModel\SubscriptionStagingDetails\CollectionFactory;

//This class is responsible to view subscription staging details table data on pop up
class ViewDetails extends Column
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    private CollectionFactory $collectionFactory;

    /**
     * Constructor
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        CollectionFactory $collectionFactory,
        array $components = [],
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                $item[$fieldName . '_html'] = "<button class='button'><span>View Details</span></button>";
                $item[$fieldName . '_title'] = __('Subscription Staging Details');
                $item[$fieldName . '_subscriptionstagingid'] = $item['subscription_staging_id'];
                $item[$fieldName . '_subscriptionstagingdetails'] = $this->getDetails($item['subscription_staging_id']);
            }
        }
        return $dataSource;
    }

    /**
     * @param $subscriptionStagingId
     * @return array
     * @throws \Exception
     */
    public function getDetails($subscriptionStagingId): array
    {
        try {
            $details = [];
            $stagingDetailsCollection = $this->collectionFactory->create()->addFieldToFilter('subscription_staging_id', ['eq' => $subscriptionStagingId]);
            $items = $stagingDetailsCollection->getItems();
            foreach ($items as $item) {
                $details[$item->getData('subscription_staging_details_id')] = $item->getData();
            }
            return $details;
        } catch (\Exception $e) {
            throw new \Exception(__('Something went wrong while fetching the records: ' . $e->getMessage()));
        }
    }
}
