<?php
/**
 * File: Sample.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

//This is the CRUD ResourceModel

/**
 * Class Sample
 * @package LizardMedia\Sample\Model\ResourceModel
 */
class Sample extends AbstractDb
{
    /**
     * This method is responsible for telling Magento which table should be used
     * for model persistence and which column is the ID.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('lizardmedia_sample', 'entity_id');
    }
}
