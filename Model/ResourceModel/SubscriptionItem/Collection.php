<?php

declare(strict_types=1);

namespace Pixafy\Subscription\Model\ResourceModel\SubscriptionItem;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'pixafy_subscription_item_collection';
    protected $_eventObject = 'pixafy_subscription_item_collection';

    /**
     * @inheirtDoc
     */
    protected function _construct()
    {
        $this->_init('Pixafy\Subscription\Model\SubscriptionItem', 'Pixafy\Subscription\Model\ResourceModel\SubscriptionItem');
    }

//    protected function _initSelect()
//    {
//        parent::_initSelect();
//
//        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
//        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
//        $connection = $resource->getConnection();
//        $sales_order = $resource->getTableName('sales_order');
//        $sales_order_item = $resource->getTableName('sales_order_item');
//        $sql ="SELECT `main_table`.*, `sales_order`.`created_at` AS `sales_order_created_at`, `sales_order`.`entity_id`, `sales_order`.`increment_id`, `sales_order`.`store_id`, `sales_order`.`subtotal`, `sales_order`.`customer_id`, `qty_ordered` AS `qtytotal` FROM $sales_order_item AS `main_table` LEFT JOIN $sales_order AS `sales_order` ON `main_table`.order_id = `sales_order`.entity_id";
//        $result = $connection->fetchAll($sql);
//
//        return $result;

//    }
}
