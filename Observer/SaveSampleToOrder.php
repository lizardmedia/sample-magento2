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
use LizardMedia\Sample\Api\Data\SampleExtensionAttributeInterface;
use LizardMedia\Sample\Api\Data\SampleExtensionAttributeInterfaceFactory;

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
     * @var SampleExtensionAttributeInterfaceFactory
     */
    private $sampleExtensionAttributeFactory;

    /**
     * SaveSampleToOrder constructor.
     * @param SampleRepositoryInterface $sampleRepository
     * @param OrderExtensionFactory $extensionFactory
     * @param SampleExtensionAttributeInterfaceFactory $sampleExtensionAttributeFactory
     */
    public function __construct(
        SampleRepositoryInterface $sampleRepository,
        OrderExtensionFactory $extensionFactory,
        SampleExtensionAttributeInterfaceFactory $sampleExtensionAttributeFactory
    ) {
        $this->sampleRepository = $sampleRepository;
        $this->extensionFactory = $extensionFactory;
        $this->sampleExtensionAttributeFactory = $sampleExtensionAttributeFactory;
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

            /** @var SampleExtensionAttributeInterface $sampleExtensionAttribute */
            $sampleExtensionAttribute = $this->sampleExtensionAttributeFactory->create();
            $sampleExtensionAttribute->setValue($sample);
            $extensionAttributes->setSample($sampleExtensionAttribute);
            $order->setExtensionAttributes($extensionAttributes);
        } catch (Exception $e) {
        }
    }
}
