<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Ui\Component\Listing\Columns;

use Magento\Framework\Escaper;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Pixafy\Subscription\Model\ResourceModel\SubscriptionItem\CollectionFactory;

//This class is responsible to render the qty field as input field on subscription item grid
class SubscriptionItemQty extends Column
{
    protected Escaper $escaper;
    private CollectionFactory $collectionFactory;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param CollectionFactory $collectionFactory
     * @param Escaper $escaper
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface   $context,
        UiComponentFactory $uiComponentFactory,
        CollectionFactory $collectionFactory,
        Escaper $escaper,
        array $components = [],
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->escaper = $escaper;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                $qty = $this->getQty($item['id']);
                $html = '<input type="text" name="qty" value="'.$qty.'">';
                $item[$fieldName] = $html;
            }
        }
        return $dataSource;
    }

    /**
     * @param $subscriptionItemId
     * @return array|mixed|null
     */
    private function getQty($subscriptionItemId)
    {
        $stagingDetailsCollection = $this->collectionFactory->create()
            ->addFieldToFilter('id', ['eq' => $subscriptionItemId]);
        $item = $stagingDetailsCollection->getLastItem();
        return $item->getData('qty');
    }
}
