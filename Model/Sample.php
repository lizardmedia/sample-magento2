<?php
/**
 * File: Sample.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Model;

use LizardMedia\Sample\Api\Data\SampleInterface;
use LizardMedia\Sample\Model\Data\SampleFactory;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;

//This is the CRUD Model

/**
 * Class Sample
 * @package LizardMedia\Sample\Model
 */
class Sample extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'lizardmedia_sample';

    /**
     * @var SampleFactory
     */
    private $sampleDataFactory;

    /**
     * Sample constructor.
     * @param SampleFactory $sampleDataFactory
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        SampleFactory $sampleDataFactory,
        Context $context,
        Registry $registry,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->sampleDataFactory = $sampleDataFactory;
    }

    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('LizardMedia\Sample\Model\ResourceModel\Sample');
    }

    /**
     * This method is required by implementing IdentityInterface
     * which is meant for caching the model data.
     *
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return SampleInterface
     */
    public function getDataModel(): SampleInterface
    {
        /** @var SampleInterface $dataObject */
        $dataObject = $this->sampleDataFactory->create();
        $dataObject->setId($this->getId());
        $dataObject->setDescription($this->getDescription());
        $dataObject->setTitle($this->getTitle());
        $dataObject->setQuoteId($this->getQuoteId());
        $dataObject->setOrderId($this->getOrderId());
        return $dataObject;
    }
}
