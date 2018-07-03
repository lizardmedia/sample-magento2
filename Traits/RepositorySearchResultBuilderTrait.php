<?php
/**
 * File: RepositorySearchResultBuilderTrait.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Traits;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Trait RepositorySearchResultBuilderTrait
 * @package LizardMedia\Sample\Trait
 */
trait RepositorySearchResultBuilderTrait
{
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param AbstractCollection $collection
     */
    protected function addFiltersToCollection(
        SearchCriteriaInterface $searchCriteria,
        AbstractCollection $collection
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
     * @param AbstractCollection $collection
     */
    protected function addSortOrdersToCollection(
        SearchCriteriaInterface $searchCriteria,
        AbstractCollection $collection
    ) {
        foreach ((array)$searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() === SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param AbstractCollection $collection
     */
    protected function addPagingToCollection(
        SearchCriteriaInterface $searchCriteria,
        AbstractCollection $collection
    ) {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param SearchResultsInterface $searchResults
     * @param AbstractCollection $collection
     * @return SearchResultsInterface
     */
    protected function buildSearchResult(
        SearchCriteriaInterface $searchCriteria,
        SearchResultsInterface $searchResults,
        AbstractCollection $collection
    ) {
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}
