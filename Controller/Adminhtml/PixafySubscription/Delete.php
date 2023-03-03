<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Controller\Adminhtml\PixafySubscription;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Pixafy\Subscription\Model\SubscriptionFactory;

/**
 * Delete record
 */
class Delete extends \Magento\Backend\App\Action
{
    protected Filter $_filter;
    protected SubscriptionFactory $subscriptionFactory;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param SubscriptionFactory $subscriptionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        SubscriptionFactory $subscriptionFactory
    ) {
        $this->_filter = $filter;
        $this->subscriptionFactory = $subscriptionFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $recordId = $this->getRequest()->getParam('subscription_id');
        if (!$recordId) {
            $this->messageManager->addErrorMessage(__('Invalid Record Id Provided'));
            return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/subscription');
        }
        try {
            $model = $this->subscriptionFactory->create();
            $model->load($recordId);
            $model->delete();
            $this->messageManager->addSuccessMessage(__('Record Deleted.'));
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__('Something went wrong while deleting the record: ' . $exception->getMessage()));
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/subscription');
    }

    /**
     * Check Category Map recode delete Permission.
     * @return bool
     */
    protected function _isAllowed():bool
    {
        return $this->_authorization->isAllowed('Pixafy_Subscription::subscription');
    }
}
