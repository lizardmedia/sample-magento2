<?php
/**
 * File: SampleSearchResultInterface.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

//This is an interface for getList results

/**
 * Interface SampleSearchResultInterface
 * @package LizardMedia\Sample\Api\Data
 */
interface SampleSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \LizardMedia\Sample\Api\Data\SampleInterface[]
     */
    public function getItems();

    /**
     * @param \LizardMedia\Sample\Api\Data\SampleInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
