<?php
/**
 * File: SampleSearchResult.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Model\Data;

use LizardMedia\Sample\Api\Data\SampleSearchResultInterface;
use Magento\Framework\Api\SearchResults;

//Concrete implementation of SampleSearchResultInterface.
//There is no need to implement anything, all necessary methods are in parent
//class and the interface provides PHPDocs required for correct class handling by Magento.

/**
 * Class SampleSearchResult
 * @package LizardMedia\Sample\Model\Data
 */
class SampleSearchResult extends SearchResults implements SampleSearchResultInterface
{

}
