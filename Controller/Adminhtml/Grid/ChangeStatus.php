<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Controller\Adminhtml\Grid;

use Pixafy\Subscription\Model\SubscriptionStagingFactory;
use Magento\Framework\Controller\ResultFactory;


/**
 * Approve status schedule staging
 */
class ChangeStatus extends \Magento\Backend\App\Action
{
    private SubscriptionStagingFactory $SubscriptionStagingFactory;
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param SubscriptionStagingFactory $subscriptionStagingFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        SubscriptionStagingFactory $subscriptionStagingFactory
    ) {
        parent::__construct($context);
        $this->SubscriptionStagingFactory = $subscriptionStagingFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $data = (int) $this->getRequest()->getParam('subscription_staging_id');
        if (!$data) {
            $this->messageManager->addSuccessMessage(__('Requested item not found.'));
            $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            return $resultRedirect;
        }
        try {
            $rowData = $this->SubscriptionStagingFactory->create()->load($data);
            $rowData->setData('is_approved',1);
            $rowData->setData($data);
            $rowData->save();
            $this->messageManager->addSuccessMessage(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }

    /**
     * @inheirtDoc
     */
    protected function _isAllowed():bool
    {
        return $this->_authorization->isAllowed('Pixafy_Subscription::subscription');
    }
}
