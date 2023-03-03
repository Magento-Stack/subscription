<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Ui\DataProvider\Subscription;

use Pixafy\Subscription\Model\ResourceModel\SubscriptionOrderSchedule\CollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\DataPersistor;

//Data Provider: Load data from Subscription Order Schedule table on the base of subscription ID
class OrderSchedule extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    private CollectionFactory $collectionFactory;
    private RequestInterface $request;
    private DataPersistor $dataPersistor;

    public function __construct(
        CollectionFactory $collectionFactory,
        RequestInterface $request,
                          $name,
                          $primaryFieldName,
                          $requestFieldName,
        DataPersistor $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
        $this->collectionFactory = $collectionFactory;
        $this->request = $request;
        $this->dataPersistor = $dataPersistor;

        $subscriptionIdRegistry = null;
        $subscriptionId = $this->request->getParam('subscription_id');
        if(!empty($subscriptionId)) {
            $this->dataPersistor->set('subscription_id', null);
            $this->dataPersistor->set('subscription_id', $subscriptionId);
            $subscriptionIdRegistry = $this->dataPersistor->get('subscription_id');
        }
        $this->collection = $collectionFactory->create()->addFieldToFilter('subscription_id', ['eq' => $subscriptionIdRegistry]);

    }
}
