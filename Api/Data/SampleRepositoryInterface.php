<?php
/**
 * File: SampleRepositoryInterface.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Api\Data;

//This is the service contract of the module.
//It provides a consistent API for handling Data Objects.

/**
 * Interface SampleRepositoryInterface
 * @package LizardMedia\Sample\Api\Data
 */
interface SampleRepositoryInterface
{
    /**
     * @param SampleInterface $sample
     * @return void
     */
    public function save(\LizardMedia\Sample\Api\Data\SampleInterface $sample);

    /**
     * @param int $id
     * @return \LizardMedia\Sample\Api\Data\SampleInterface
     */
    public function getById($id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \LizardMedia\Sample\Api\Data\SampleSearchResultInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * @param \LizardMedia\Sample\Api\Data\SampleInterface $sample
     * @return void
     */
    public function delete(\LizardMedia\Sample\Api\Data\SampleInterface $sample);

    /**
     * @param int $id
     * @return \LizardMedia\Sample\Api\Data\SampleSearchResultInterface
     */
    public function deleteById($id);

    /**
     * @param int $cartId
     * @param SampleInterface $sample
     * @return void
     */
    public function saveSampleFromCheckout(int $cartId, SampleInterface $sample);

    /**
     * @param string $cartId
     * @param SampleInterface $sample
     * @return void
     */
    public function saveSampleFromGuestCheckout(string $cartId, SampleInterface $sample);

    /**
     * @param int $id
     * @return \LizardMedia\Sample\Api\Data\SampleInterface
     */
    public function getByQuoteId($id);

    /**
     * @param int $id
     * @return \LizardMedia\Sample\Api\Data\SampleInterface
     */
    public function getByOrderId($id);
}
