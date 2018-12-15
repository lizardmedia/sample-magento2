<?php
/**
 * File: AmqpMessage.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Logger\Handler;

use Magento\Framework\Logger\Handler\Base;
use Monolog\Logger;

/**
 * Class AmqpMessage
 * @package LizardMedia\Sample\Logger\Handler
 */
class AmqpMessage extends Base
{
    /**
     * @var string
     */
    protected $fileName = '/var/log/lizardmedia/amqp.log';

    /**
     * @var int
     */
    protected $loggerType = Logger::INFO;
}
