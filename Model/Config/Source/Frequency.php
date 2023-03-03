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
 * Custom Frequency manager to handle hourly cron configuration
 */
class Frequency implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var array
     */
    protected static $options;

    const CRON_HOURLY = 'H';
    const CRON_WEEKLY = 'W';
    const CRON_MONTHLY = 'M';

    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        if (!self::$options) {
            self::$options = [
                ['label' => __('Hourly'), 'value' => self::CRON_HOURLY],
                ['label' => __('Weekly'), 'value' => self::CRON_WEEKLY],
                ['label' => __('Monthly'), 'value' => self::CRON_MONTHLY],
            ];
        }
        return self::$options;
    }
}
