<?php
/**
 * Pixafy_Subscription extension
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category  Pixafy
 * @package   Pixafy_Subscription
 * @copyright Copyright (c) 2022
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */

declare(strict_types=1);

namespace Pixafy\Subscription\Model\Config;

use Pixafy\Subscription\Model\Config\Source\Frequency;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\ValueFactory;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;

/**
 * Cron config setting for X3 Visibility Cron Schedule
 */
class X3VisibilityCronConfig extends \Magento\Framework\App\Config\Value
{
    const CRON_STRING_PATH = 'crontab/default/jobs/pixafy_subscription_x3Visibility/schedule/cron_expr';
    const CRON_MODEL_PATH = 'crontab/default/jobs/pixafy_subscription_x3Visibility/run/model';

    /**
     * @var ValueFactory
     */
    protected ValueFactory $_configValueFactory;

    /**
     * @var mixed|string
     */
    protected $_runModelPath = '';

    /**
     * @param Context $context
     * @param Registry $registry
     * @param ScopeConfigInterface $config
     * @param TypeListInterface $cacheTypeList
     * @param ValueFactory $configValueFactory
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param $runModelPath
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        ScopeConfigInterface $config,
        TypeListInterface $cacheTypeList,
        ValueFactory $configValueFactory,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        $runModelPath = '',
        array $data = []
    ) {
        $this->_runModelPath = $runModelPath;
        $this->_configValueFactory = $configValueFactory;
        parent::__construct($context, $registry, $config, $cacheTypeList, $resource, $resourceCollection, $data);
    }


    /**
     * @return X3VisibilityCronConfig
     * @throws \Exception
     */
    public function afterSave(): X3VisibilityCronConfig
    {
        $time = $this->getData('groups/general/fields/x3Visibility_cronTime/value');
        $frequency = $this->getData('groups/general/fields/x3_cron/value');

        $x3cronExprArray = [
            intval($time[1]),
            $frequency == Frequency::CRON_HOURLY && intval($time[0]) == "00" ? '*' : intval($time[0]),
            $frequency == Frequency::CRON_MONTHLY ? '1' : '*',
            '*',
            $frequency == Frequency::CRON_WEEKLY ? '1' : '*',
        ];

        $x3cronExprString = join(' ', $x3cronExprArray);

        try {
            $this->_configValueFactory->create()->load(
                self::CRON_STRING_PATH,
                'path'
            )->setValue(
                $x3cronExprString
            )->setPath(
                self::CRON_STRING_PATH
            )->save();

            $this->_configValueFactory->create()->load(
                self::CRON_MODEL_PATH,
                'path'
            )->setValue(
                $this->_runModelPath
            )->setPath(
                self::CRON_MODEL_PATH
            )->save();
        } catch (\Exception $e) {
            throw new \Exception((string)__('Something went wrong. We can\'t save the x3 visibility cron expression.'));
        }

        return parent::afterSave();
    }
}
