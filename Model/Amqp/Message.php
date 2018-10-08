<?php
declare(strict_types=1);

/**
 * File: Message.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Model\Amqp;

use LizardMedia\Sample\Api\Amqp\MessageInterface;

/**
 * Class Message
 * @package LizardMedia\Sample\Model\Amqp
 */
class Message implements MessageInterface
{
    /**
     * @var string
     */
    private $message;

    /**
     * @param string $message
     * @return void
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
