<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Controller\Adminhtml\PixafySubscription;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Registry;
use Pixafy\Subscription\Model\SubscriptionFactory;

/**
 *  Grid List Controller.
 */
class Edit extends \Magento\Backend\App\Action
{
    private Registry $coreRegistry;
    private SubscriptionFactory $subscriptionFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param Registry $coreRegistry
     * @param SubscriptionFactory $subscriptionFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        Registry $coreRegistry,
        SubscriptionFactory $subscriptionFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->subscriptionFactory = $subscriptionFactory;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $rowId = (int) $this->getRequest()->getParam('subscription_id');
        $rowData = $this->subscriptionFactory->create();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($rowId) {
            $rowData = $rowData->load($rowId);
            $rowTitle = $rowData->getShipSite();
            if (!$rowData->getSubscriptionId()) {
                $this->messageManager->addError(__('row data no longer exist.'));
                return $this->_redirect('grid/grid/rowdata');
            }
        }

        $this->coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Subscriptions').$rowTitle : __('Add Row Data');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

    /**
     * @inheriDoc
     */
    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Pixafy_Subscription::subscription');
    }
}
