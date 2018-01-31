<?php
/**
 * File: AbstractController.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Controller\Adminhtml\Sample;

use Magento\Backend\App\Action;

//Abstract controller for all sample-related controllers. Ensures all controllers
//are behind the ACL resource defined in this class.

/**
 * Class AbstractController
 * @package LizardMedia\Sample\Controller\Adminhtml\Sample
 */
abstract class AbstractController extends Action
{
    const ADMIN_RESOURCE = 'LizardMedia_Sample::sample_manage';
}
