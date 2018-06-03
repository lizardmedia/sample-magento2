<?php
/**
 * File: OrderRepository.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Plugin;

use Exception;
use LizardMedia\Sample\Api\Data\SampleInterface;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use LizardMedia\Sample\Api\Data\SampleRepositoryInterface;
use Magento\Sales\Api\Data\OrderExtensionFactory;
use LizardMedia\Sample\Api\Data\SampleExtensionAttributeInterface;
use LizardMedia\Sample\Api\Data\SampleExtensionAttributeInterfaceFactory;

/**
 * Class OrderRepository
 * @package LizardMedia\Sample\Plugin
 */
class OrderRepository
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
     * @param OrderRepositoryInterface $subject
     * @param OrderInterface $result
     * @return OrderInterface
     */
    public function afterSave(OrderRepositoryInterface $subject, OrderInterface $result)
    {
        if ($result->getExtensionAttributes() && $result->getExtensionAttributes()->getSample()) {
            /** @var SampleInterface $sample */
            $sample = $result->getExtensionAttributes()->getSample()->getValue();
            $sample->setOrderId((int)$result->getEntityId());
            $this->sampleRepository->save($sample);
        }
        return $result;
    }

    /**
     * @param OrderRepositoryInterface $subject
     * @param OrderInterface $result
     * @return OrderInterface
     */
    public function afterGet(OrderRepositoryInterface $subject, OrderInterface $result)
    {
        try {
            $sample = $this->sampleRepository->getByOrderId((int)$result->getEntityId());
            /** @var SampleExtensionAttributeInterface $sampleExtensionAttribute */
            $sampleExtensionAttribute = $this->sampleExtensionAttributeFactory->create();
            $sampleExtensionAttribute->setValue($sample);

            $extensionAtrributes = $result->getExtensionAttributes() ?? $this->extensionFactory->create();
            $extensionAtrributes->setSample($sampleExtensionAttribute);
            $result->setExtensionAttributes($extensionAtrributes);
        } catch (Exception $e) {
        }
        return $result;
    }
}
