<?php
declare(strict_types=1);

/**
 * File: PublishMessageCommand.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\MessageQueue\PublisherInterface;
use LizardMedia\Sample\Api\Amqp\MessageInterface;
use LizardMedia\Sample\Api\Amqp\MessageInterfaceFactory;

/**
 * Class PublishMessageCommand
 * @package LizardMedia\Sample\Console\Command
 */
class PublishMessageCommand extends Command
{
    const COMMAND_QUEUE_MESSAGE_PUBLISH = 'lm-sample:message-publish';

    const MESSAGE_ARG = 'message';
    const TOPIC_ARG = 'topic';

    /**
     * @var PublisherInterface
     */
    protected $publisher;

    /**
     * @var MessageInterfaceFactory
     */
    private $messageFactory;


    /**
     * @param PublisherInterface $publisher
     * @param MessageInterfaceFactory $messageFactory
     * @param null $name
     */
    public function __construct(
        PublisherInterface $publisher,
        MessageInterfaceFactory $messageFactory,
        $name = null
    ) {
        $this->publisher = $publisher;
        $this->messageFactory = $messageFactory;
        parent::__construct($name);
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName(self::COMMAND_QUEUE_MESSAGE_PUBLISH);
        $this->setDescription('Publish a message to a topic');
        $this->setDefinition([
            new InputArgument(
                self::MESSAGE_ARG,
                InputArgument::REQUIRED,
                'Message'
            ),
            new InputArgument(
                self::TOPIC_ARG,
                InputArgument::REQUIRED,
                'Topic'
            ),
        ]);
        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $message = $input->getArgument(self::MESSAGE_ARG);
        $topic = $input->getArgument(self::TOPIC_ARG);

        try {
            /** @var MessageInterface $messageObject */
            $messageObject = $this->messageFactory->create();
            $messageObject->setMessage($message);
            $this->publisher->publish($topic, $messageObject);
            $output->writeln(sprintf('Published message "%s" to topic "%s"', $message, $topic));
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
        }
    }
}
