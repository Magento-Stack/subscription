<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Controller\Adminhtml\PixafySubscription;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Subscription extends \Magento\Backend\App\Action
{
    /**
     * @var bool|PageFactory
     */
    protected $resultPageFactory = false;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Subscriptions')));
        return $resultPage;
    }
}
