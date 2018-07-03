<?php
/**
 * File: SampleRepository.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Model;

use LizardMedia\Sample\Api\Data\SampleInterface;
use LizardMedia\Sample\Api\Data\SampleRepositoryInterface;
use LizardMedia\Sample\Api\Data\SampleSearchResultInterfaceFactory;
use LizardMedia\Sample\Api\Data\SampleSearchResultInterface;
use LizardMedia\Sample\Model\ResourceModel\Sample as SampleResource;
use LizardMedia\Sample\Model\ResourceModel\Sample\CollectionFactory;
use LizardMedia\Sample\Model\SampleFactory;
use LizardMedia\Sample\Traits\RepositorySearchResultBuilderTrait;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Model\QuoteIdMaskFactory;
use Magento\Quote\Model\ResourceModel\Quote\QuoteIdMask as QuoteIdMaskResource;

//This is the implementation of the service contract of the module.
//Public methods are the provide the API of the class.
//
//Remember to
//* not use strict scalar parameters and return types
//* use fully-qualified class names
//* declare the parameter and return types only in PHPDoc
//* declare the return type in PHPDoc even if it's void
//It's because Magento scans the PHPDocs to determine all necessary data types.

/**
 * Class SampleRepository
 * @package LizardMedia\Sample\Model
 */
class SampleRepository implements SampleRepositoryInterface
{
    use RepositorySearchResultBuilderTrait;

    /**
     * @var SampleResource
     */
    private $sampleResource;

    /**
     * @var SampleFactory
     */
    private $sampleFactory;

    /**
     * @var CollectionFactory
     */
    private $sampleCollectionFactory;

    /**
     * @var SampleSearchResultInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * @var QuoteIdMaskFactory
     */
    private $quoteIdMaskFactory;

    /**
     * @var QuoteIdMaskResource
     */
    private $quoteIdMaskResource;

    /**
     * SampleRepository constructor.
     * @param SampleResource $sampleResource
     * @param SampleFactory $sampleFactory
     * @param CollectionFactory $sampleCollectionFactory
     * @param SampleSearchResultInterfaceFactory $searchResultFactory
     * @param QuoteIdMaskFactory $quoteIdMaskFactory
     * @param QuoteIdMaskResource $quoteIdMaskResource
     */
    public function __construct(
        SampleResource $sampleResource,
        SampleFactory $sampleFactory,
        CollectionFactory $sampleCollectionFactory,
        SampleSearchResultInterfaceFactory $searchResultFactory,
        QuoteIdMaskFactory $quoteIdMaskFactory,
        QuoteIdMaskResource $quoteIdMaskResource
    ) {
        $this->sampleResource = $sampleResource;
        $this->sampleFactory = $sampleFactory;
        $this->sampleCollectionFactory = $sampleCollectionFactory;
        $this->searchResultFactory = $searchResultFactory;
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
        $this->quoteIdMaskResource = $quoteIdMaskResource;
    }

    /**
     * @param \LizardMedia\Sample\Api\Data\SampleInterface $sample
     * @return void
     * @throws \Exception
     * @throws AlreadyExistsException
     */
    public function save(\LizardMedia\Sample\Api\Data\SampleInterface $sample)
    {
        /** @var Sample $sampleModel */
        $sampleModel = $this->sampleFactory->create();
        if ($sample->getId()) {
            $this->sampleResource->load($sampleModel, $sample->getId());
        }
        $sampleModel->setTitle($sample->getTitle());
        $sampleModel->setDescription($sample->getDescription());
        $sampleModel->setQuoteId($sample->getQuoteId());
        $sampleModel->setOrderId($sample->getOrderId());
        $this->sampleResource->save($sampleModel);
    }

    /**
     * @param int $id
     * @return \LizardMedia\Sample\Api\Data\SampleInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id): \LizardMedia\Sample\Api\Data\SampleInterface
    {
        /** @var Sample $sampleModel */
        $sampleModel = $this->sampleFactory->create();
        $this->sampleResource->load($sampleModel, $id);
        if (!$sampleModel->getId()) {
            throw new NoSuchEntityException();
        }
        return $sampleModel;
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \LizardMedia\Sample\Api\Data\SampleSearchResultInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        /** @var SampleResource\Collection $collection */
        $collection = $this->sampleCollectionFactory->create();

        //Helper methods for translating search criteria to collection filters etc.
        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        /** @var SampleSearchResultInterface $searchResult */
        $searchResult = $this->searchResultFactory->create();
        return $this->buildSearchResult($searchCriteria, $searchResult, $collection);
    }

    /**
     * @param \LizardMedia\Sample\Api\Data\SampleInterface $sample
     * @return void
     * @throws \Exception
     */
    public function delete(\LizardMedia\Sample\Api\Data\SampleInterface $sample)
    {
        $this->deleteById($sample->getId());
    }

    /**
     * @param int $id
     * @return void
     * @throws \Exception
     */
    public function deleteById($id)
    {
        /** @var Sample $sampleModel */
        $sampleModel = $this->sampleFactory->create();
        $this->sampleResource->load($sampleModel, $id);
        $this->sampleResource->delete($sampleModel);
    }

    /**
     * @param int $cartId
     * @param SampleInterface $sample
     * @return void
     */
    public function saveSampleFromCheckout(int $cartId, SampleInterface $sample)
    {
        try {
            $sampleToSave = $this->getByQuoteId($cartId);
            $sampleToSave->setTitle($sample->getTitle());
            $sampleToSave->setDescription($sample->getDescription());
        } catch (NoSuchEntityException $e) {
            $sampleToSave = $sample;
            $sampleToSave->setQuoteId($cartId);
        }
        $this->save($sampleToSave);
    }

    /**
     * @param string $cartId
     * @param SampleInterface $sample
     * @return void
     */
    public function saveSampleFromGuestCheckout(string $cartId, SampleInterface $sample)
    {
        $quoteIdMask = $this->quoteIdMaskFactory->create();
        $this->quoteIdMaskResource->load($quoteIdMask, $cartId, 'masked_id');
        $this->saveSampleFromCheckout((int)$quoteIdMask->getQuoteId(), $sample);
    }

    /**
     * @param int $id
     * @return \LizardMedia\Sample\Api\Data\SampleInterface
     * @throws NoSuchEntityException
     */
    public function getByQuoteId($id)
    {
        /** @var Sample $sampleModel */
        $sampleModel = $this->sampleFactory->create();
        $this->sampleResource->load($sampleModel, $id, SampleInterface::QUOTE_ID);
        if (!$sampleModel->getId()) {
            throw new NoSuchEntityException();
        }
        return $sampleModel;
    }

    /**
     * @param int $id
     * @return \LizardMedia\Sample\Api\Data\SampleInterface
     * @throws NoSuchEntityException
     */
    public function getByOrderId($id)
    {
        /** @var Sample $sampleModel */
        $sampleModel = $this->sampleFactory->create();
        $this->sampleResource->load($sampleModel, $id, SampleInterface::ORDER_ID);
        if (!$sampleModel->getId()) {
            throw new NoSuchEntityException();
        }
        return $sampleModel;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param SampleResource\Collection $collection
     */
    private function addFiltersToCollection(
        SearchCriteriaInterface $searchCriteria,
        SampleResource\Collection $collection
    ) {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }
}
