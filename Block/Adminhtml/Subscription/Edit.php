<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Block\Adminhtml\Subscription;
use Magento\Backend\Block\Widget\Form\Container;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

//Edit Subscription Entity
class Edit extends Container
{
    protected $_coreRegistry = null;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context  $context,
        Registry $registry,
        array    $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        $this->_objectId = 'subscription_id';
        $this->_controller = 'adminhtml_subscription';
        $this->_blockGroup = 'Pixafy_Subscription';
        parent::_construct();
    }

    protected function _prepareLayout()
    {
        $this->buttonList->remove('reset');
        $this->buttonList->update('save', 'onclick', 'setLocation(\'' . $this->getUrl('subscription/pixafysubscription/save') . '\')');
        $this->buttonList->update('back', 'onclick', 'setLocation(\'' . $this->getUrl('subscription/pixafysubscription/subscription') . '\')');
        return parent::_prepareLayout();
    }
}
