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

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;
use Pixafy\Subscription\Model\Config\Source\IntervalTypeOptions;

/**
 * Class Subscription Periods dynamic configuration
 */
class SubscriptionPeriods extends AbstractFieldArray
{
    /**
     * @var IntervalTypeOptions
     */
    private $_intervalTypeRenderer;

    /**
     * Prepare rendering the new field by adding all the needed columns
     * @throws LocalizedException
     */
    protected function _prepareToRender()
    {
        $this->addColumn('interval_type', ['label' => __('Interval Type'), 'renderer' => $this->getIntervalRenderer(), 'class' => 'required-entry']);
        $this->addColumn('interval_number', ['label' => __('Interval Number'), 'class' => 'required-entry validate-number']);
        $this->addColumn('interval_label', ['label' => __('Interval Label'), 'class' => 'required-entry']);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }

    /**
     * @param DataObject $row
     * @return void
     * @throws LocalizedException
     */
    protected function _prepareArrayRow(DataObject $row): void
    {
        $options = [];
        $intervalType = $row->getIntervalType();
        if ($intervalType !== null)
        {
            $options['option_' . $this->getIntervalRenderer()->calcOptionHash($intervalType)] = 'selected="selected"';
        }
        $row->setData('option_extra_attrs', $options);
    }

    /**
     * @return IntervalTypeOptions
     * @throws LocalizedException
     */
    private function getIntervalRenderer()
    {
        if (!$this->_intervalTypeRenderer) {
            $this->_intervalTypeRenderer = $this->getLayout()->createBlock(
                IntervalTypeOptions::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]);
        }
        return $this->_intervalTypeRenderer;
    }
}
