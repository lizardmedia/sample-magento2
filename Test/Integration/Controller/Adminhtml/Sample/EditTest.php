<?php
/**
 * File: EditTest.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Test\Integration\Controller\Adminhtml\Sample;

use Magento\TestFramework\TestCase\AbstractBackendController;

/**
 * Class EditTest
 * @package LizardMedia\Sample\Test\Integration\Controller\Adminhtml\Sample
 */
class EditTest extends AbstractBackendController
{
    /**
     * @var string
     */
    protected $resource = 'LizardMedia_Sample::sample_manage';
    /**
     * @var string
     */
    protected $uri = 'backend/sample/sample/delete';
}
