<?php
/**
 * File: Collection.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Model\ResourceModel\Sample;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

//This is the CRUD Collection

/**
 * Class Collection
 * @package LizardMedia\Sample\Model\ResourceModel
 */
class Collection extends AbstractCollection
{
    /**
     * This function is responsible for telling Magento about the model
     * and resource model for the collection class.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'LizardMedia\Sample\Model\Sample',
            'LizardMedia\Sample\Model\ResourceModel\Sample'
        );
    }
}
