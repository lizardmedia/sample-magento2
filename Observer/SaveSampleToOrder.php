<?php
/**
 * File: SaveSampleToOrder.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Observer;

use Exception;
use LizardMedia\Sample\Api\Data\SampleRepositoryInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\Quote;
use Magento\Sales\Model\Order;
use Magento\Sales\Api\Data\OrderExtensionFactory;

/**
 * Class SaveSampleToOrder
 * @package LizardMedia\Sample\Observer
 */
class SaveSampleToOrder implements ObserverInterface
{
    /**
     * @var SampleRepositoryInterface
     */
    private $sampleRepository;

    /**
     * @var OrderExtensionFactory
     */
    private $extensionFactory;

    /**
     * SaveSampleToOrder constructor.
     * @param SampleRepositoryInterface $sampleRepository
     * @param OrderExtensionFactory $extensionFactory
     */
    public function __construct(
        SampleRepositoryInterface $sampleRepository,
        OrderExtensionFactory $extensionFactory
    ) {
        $this->sampleRepository = $sampleRepository;
        $this->extensionFactory = $extensionFactory;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        /** @var Order $order */
        $order = $observer->getEvent()->getOrder();
        /** @var Quote $quote */
        $quote = $observer->getEvent()->getQuote();
        try {
            $sample = $this->sampleRepository->getByQuoteId((int)$quote->getId());
            $extensionAttributes = $order->getExtensionAttributes() ?? $this->extensionFactory->create();

            $extensionAttributes->setSample($sample);
            $order->setExtensionAttributes($extensionAttributes);
        } catch (Exception $e) {
        }
    }
}
