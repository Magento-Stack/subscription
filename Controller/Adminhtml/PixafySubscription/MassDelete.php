<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Controller\Adminhtml\PixafySubscription;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Pixafy\Subscription\Model\ResourceModel\Subscription\CollectionFactory;

/**
 * Delete record
 */
class MassDelete extends \Magento\Backend\App\Action
{
    protected Filter $_filter;
    protected CollectionFactory $_collectionFactory;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {

        $this->_filter = $filter;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try {
            $collection = $this->_filter->getCollection($this->_collectionFactory->create());
            $recordDeleted = 0;
            foreach ($collection->getItems() as $record) {
                $record->setId($record->getId());
                $record->delete();
                $recordDeleted++;
            }
            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $recordDeleted));
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__('Something went wrong while deleting the record(s): ' . $exception->getMessage()));
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
