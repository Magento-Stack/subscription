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

namespace Pixafy\Subscription\Model\Config\Source;

/**
 *  Interval Type Options Class
 */
class IntervalTypeOptions extends \Magento\Framework\View\Element\Html\Select
{
    /**
     * @param $value
     * @return mixed
     */
    public function setInputName($value)
    {
        return $this->setName($value);
    }

    /**
     * @param $value
     * @return IntervalTypeOptions
     */
    public function setInputId($value)
    {
        return $this->setId($value);
    }

    /**
     * @return string
     */
    public function _toHtml(): string
    {
        if (!$this->getOptions()) {
            $this->setOptions($this->getTypeOptions());
        }
        return parent::_toHtml();
    }

    /**
     * @return \string[][]
     */
    private function getTypeOptions(): array
    {
        return [
            ['label' => 'Day', 'value' => 'Day'],
            ['label' => 'Week', 'value' => 'Week'],
            ['label' => 'Month', 'value' => 'Month'],
            ['label' => 'Year', 'value' => 'Year']
        ];
    }
}
