<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Controller\Adminhtml\PixafySubscription;

use Pixafy\Subscription\Model\SubscriptionFactory;
use Magento\Framework\Registry;

/**
 * TO SAVE NEW RECORDS IN GRID
 */
class Save extends \Magento\Backend\App\Action
{
    private SubscriptionFactory $SubscriptionFactory;
    private Registry $registry;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param SubscriptionFactory $subscriptionFactory
     * @param Registry $registry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        SubscriptionFactory $subscriptionFactory,
        Registry $registry
    ) {
        parent::__construct($context);
        $this->SubscriptionFactory = $subscriptionFactory;
        $this->registry = $registry;
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
        try {
            $rowData = $this->SubscriptionFactory->create();
            $rowData->setData($data);
            if (isset($data['subscription_id'])) {
                $rowData->setEntityId($data['subscription_id']);
            }
            $rowData->save();
            $this->messageManager->addSuccessMessage(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }
        $this->_redirect('subscription/pixafysubscription/subscription');
    }

    /**
     * @inheirtDoc
     */
    protected function _isAllowed():bool
    {
        return $this->_authorization->isAllowed('Pixafy_Subscription::subscription');
    }
}
