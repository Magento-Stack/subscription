<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Controller\Adminhtml\PixafySubscription;

use Pixafy\Subscription\Model\SubscriptionStagingFactory;
use Pixafy\Subscription\Model\SubscriptionRepository;
use Pixafy\Subscription\Model\SubscriptionItemFactory;
use Pixafy\Subscription\Model\SubscriptionStagingDetailsFactory;
use Magento\Backend\Model\Session;

/**
 * TO SAVE NEW RECORDS IN GRID
 */
class StageSave extends \Magento\Backend\App\Action
{
    private SubscriptionStagingFactory $SubscriptionStagingFactory;
    private SubscriptionItemFactory $SubscriptionItemFactory;
    private SubscriptionRepository $SubscriptionRepository;
    private SubscriptionStagingDetailsFactory $SubscriptionStagingDetailsFactory;
    private Session $session;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param SubscriptionStagingFactory $subscriptionStagingRepository
     * @param SubscriptionItemFactory $subscriptionItemRepository
     * @param SubscriptionRepository $subscriptionRepository
     * @param SubscriptionStagingDetailsFactory $subscriptionStagingDetailsRepository
     * @param Session $session
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        SubscriptionStagingFactory $subscriptionStagingRepository,
        SubscriptionItemFactory $subscriptionItemRepository,
        SubscriptionRepository $subscriptionRepository,
        SubscriptionStagingDetailsFactory $subscriptionStagingDetailsRepository,
        Session $session
    ) {
        parent::__construct($context);
        $this->SubscriptionStagingFactory = $subscriptionStagingRepository;
        $this->SubscriptionRepository = $subscriptionRepository;
        $this->SubscriptionItemFactory = $subscriptionItemRepository;
        $this->SubscriptionStagingDetailsFactory = $subscriptionStagingDetailsRepository;
        $this->session = $session;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('subscription/pixafysubscription/edit');
            return $this->_redirect('subscription/pixafysubscription/subscription');
        }
        if(isset($data['productQtyarr'])){
            $this->session->setProductQtyarr($data['productQtyarr']);
        }else {
            $subscription_id = $data['subscription_id'];
            $date_created = $data['date_created'];
            $date_scheduled = date("Y-m-d", strtotime($data['order_schedule_date']));
            $user_id = $data['customer_id'];
            $name = $data['name'];
            $bpc_name = $data['bpc_name'];
            $subscription_interval_label = $data['subscription_interval_label'];
            $ponumber = $data['ponumber'];
            $next_ship_date = date("Y-m-d", strtotime($data['next_ship_date']));
            $notes = $data['notes'];
            try {
                $rowData = $this->SubscriptionRepository->get((int)$subscription_id);
                $rowStageData = $this->SubscriptionStagingFactory->create();
                $rowItemsData = $this->SubscriptionItemFactory->create();
                $Itemsqty = $rowItemsData->getCollection()->addFieldToFilter('subscription_id', $subscription_id)->getData();

                if ($data) {
                    $StageData = ['subscription_id' => $subscription_id,
                        'date_created' => $date_created,
                        'date_scheduled' => $date_scheduled,
                        'is_approved' => 0,
                        'is_executed' => 0,
                        'user_id' => $user_id
                    ];
                }
                $rowStageData->setData($StageData);
                $rowStageData->save();
                $subscription_staging_id = $rowStageData->getData('subscription_staging_id');

                if($rowData->getData('name') !== $name){
                    $this->SaveStageData($subscription_staging_id, 'name', $rowData->getData('name'), $name, $notes);
                }
                if($rowData->getData('bpc_name') !== $bpc_name){
                    $this->SaveStageData($subscription_staging_id, 'bpc_name', $rowData->getData('bpc_name'), $bpc_name, $notes);
                }
                if($rowData->getData('subscription_interval_label') !== $subscription_interval_label){
                    $this->SaveStageData($subscription_staging_id, 'subscription_interval_label', $rowData->getData('subscription_interval_label'), $subscription_interval_label, $notes);
                }
                if($rowData->getData('ponumber') !== $ponumber){
                    $this->SaveStageData($subscription_staging_id, 'ponumber', $rowData->getData('ponumber'), $ponumber, $notes);
                }
                if($rowData->getData('next_ship_date') !== $next_ship_date){
                    $this->SaveStageData($subscription_staging_id, 'next_ship_date', $rowData->getData('next_ship_date'), $next_ship_date, $notes);
                }
                if($rowData->getData('order_schedule_date') !== $date_scheduled){
                    $this->SaveStageData($subscription_staging_id, 'order_schedule_date', $rowData->getData('order_schedule_date'), $date_scheduled, $notes);
                }
                /*if($rowData->getData('notes') !== $notes){
                    $this->SaveStageData($subscription_staging_id, 'notes', $rowData->getData('notes'), $notes, $notes);
                }*/

                $ProductsQtyArr = $this->session->getProductQtyarr();
                $i = 0;
                foreach ($ProductsQtyArr as $productQty){
                    if($Itemsqty[$i]['qty'] !== $productQty['qty']){
                        $this->SaveStageData($subscription_staging_id, 'qty', $Itemsqty[$i]['qty'], $productQty['qty'], $notes . ' ITMREF => ' . $Itemsqty[$i]['itmref']);
                    }
                    $i++;
                }


                $this->messageManager->addSuccessMessage(__('Data has been successfully saved.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__($e->getMessage()));
            }
            $this->_redirect('subscription/pixafysubscription/subscription');
        }
    }

    /**
     * @inheirtDoc
     */
    public function SaveStageData($subscription_staging_id, $field_name, $old_value, $new_value, $notes){
        $rowDetailsData = $this->SubscriptionStagingDetailsFactory->create();
        $stageDetailsData = ['subscription_staging_id' => $subscription_staging_id, 'field_name' => $field_name,
            'old_value' => $old_value, 'new_value' =>$new_value, 'notes' => $notes ];
        $rowDetailsData->setData($stageDetailsData);
        $rowDetailsData->save();
    }

    /**
     * @inheirtDoc
     */
    protected function _isAllowed():bool
    {
        return $this->_authorization->isAllowed('Pixafy_Subscription::subscription');
    }
}
