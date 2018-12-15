<?php
declare(strict_types=1);

/**
 * File: SubscriberInterface.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Api\Amqp;

/**
 * Interface SubscriberInterface
 * @package LizardMedia\Sample\Api\Amqp
 */
interface SubscriberInterface
{
    /**
     * @param MessageInterface $message
     * @return void
     */
    public function processMessage(MessageInterface $message): void;
}
