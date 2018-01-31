<?php
/**
 * File: BackButton.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Block\Adminhtml\Sample\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

//Button for resetting sample edit form (refreshes page).

/**
 * Class ResetButton
 * @package LizardMedia\Sample\Block\Adminhtml\Sample\Edit
 */
class ResetButton extends AbstractButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Reset'),
            'class' => 'reset',
            'on_click' => 'location.reload();',
            'sort_order' => 30
        ];
    }
}
