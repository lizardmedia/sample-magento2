<?php
/**
 * File: Sample.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Logger\Handler;

use Magento\Framework\Logger\Handler\Base;
use Monolog\Logger;

//Simple log handler implementation. It defines the the file to write the logs.
//You can extends the base class further to customize e.g. the way the logs
//are saved.

/**
 * Class Sample
 * @package LizardMedia\Sample\Logger\Handler
 */
class Sample extends Base
{
    protected $fileName = '/var/log/lizardmedia/sample.log';
    protected $loggerType = Logger::DEBUG;
}
