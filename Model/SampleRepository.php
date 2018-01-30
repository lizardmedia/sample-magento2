<?php
/**
 * File: SampleRepository.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Model;

use LizardMedia\Sample\Api\Data\SampleRepositoryInterface;
use LizardMedia\Sample\Api\Data\SampleSearchResultInterfaceFactory;
use LizardMedia\Sample\Api\Data\SampleSearchResultInterface;
use LizardMedia\Sample\Model\ResourceModel\Sample as SampleResource;
use LizardMedia\Sample\Model\ResourceModel\Sample\CollectionFactory;
use LizardMedia\Sample\Model\SampleFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;

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
     * SampleRepository constructor.
     * @param SampleResource $sampleResource
     * @param SampleFactory $sampleFactory
     * @param CollectionFactory $sampleCollectionFactory
     * @param SampleSearchResultInterfaceFactory $searchResultFactory
     */
    public function __construct(
        SampleResource $sampleResource,
        SampleFactory $sampleFactory,
        CollectionFactory $sampleCollectionFactory,
        SampleSearchResultInterfaceFactory $searchResultFactory
    ) {
        $this->sampleResource = $sampleResource;
        $this->sampleFactory = $sampleFactory;
        $this->sampleCollectionFactory = $sampleCollectionFactory;
        $this->searchResultFactory = $searchResultFactory;
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
        return $sampleModel->getDataModel();
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \LizardMedia\Sample\Api\Data\SampleInterface[]
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        /** @var SampleResource\Collection $collection */
        $collection = $this->sampleCollectionFactory->create();

        //Helper methods for translating search criteria to collection filters etc.
        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        return $this->buildSearchResult($searchCriteria, $this->getDataObjects($collection));
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

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param SampleResource\Collection $collection
     */
    private function addSortOrdersToCollection(
        SearchCriteriaInterface $searchCriteria,
        SampleResource\Collection $collection
    ) {
        foreach ((array)$searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param SampleResource\Collection $collection
     */
    private function addPagingToCollection(
        SearchCriteriaInterface $searchCriteria,
        SampleResource\Collection $collection
    ) {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    private function getDataObjects(SampleResource\Collection $collection): array
    {
        $collection->load();
        $sampleDataObjects = [];
        /** @var Sample $item */
        foreach ($collection as $item) {
            $sampleDataObjects[] = $item->getDataModel();
        }
        return $sampleDataObjects;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param array $sampleDataObjects
     * @return \LizardMedia\Sample\Api\Data\SampleInterface[]
     */
    private function buildSearchResult(
        SearchCriteriaInterface $searchCriteria,
        array $sampleDataObjects
    ) {
        /** @var SampleSearchResultInterface $searchResults */
        $searchResults = $this->searchResultFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($sampleDataObjects);
        $searchResults->setTotalCount(count($sampleDataObjects));

        return $searchResults->getItems();
    }
}
