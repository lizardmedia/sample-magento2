<?php
/**
 * File: Sample.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Model;

use LizardMedia\Sample\Api\Data\SampleInterface;
use LizardMedia\Sample\Model\SampleFactory;
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
class Sample extends AbstractModel implements IdentityInterface, SampleInterface
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
     * @return string
     */
    public function getTitle(): string
    {
        return (string)$this->getData(self::TITLE);
    }

    /**
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->setData(self::TITLE, $title);
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return (string)$this->getData(self::DESCRIPTION);
    }

    /**
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * @return int|null
     */
    public function getQuoteId()
    {
        return $this->getData(self::QUOTE_ID);
    }

    /**
     * @param int|null $id
     * @return void
     */
    public function setQuoteId($id): void
    {
        $this->setData(self::QUOTE_ID, $id);
    }

    /**
     * @return int|null
     */
    public function getOrderId()
    {
        return $this->getData(self::ORDER_ID);
    }

    /**
     * @param int|null $id
     * @return void
     */
    public function setOrderId($id): void
    {
        $this->setData(self::ORDER_ID, $id);
    }
}
