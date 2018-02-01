<?php
/**
 * File: ProductSaveController.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

//Observer implementation.

/**
 * Class ProductSaveController
 */
class ProductSaveController implements ObserverInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * ProductSaveController constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $passedValue = $observer->getData('passed_argument');
        $this->logger->debug("Observer called. Data passed: {$passedValue}");
    }
}
