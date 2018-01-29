<?php
/**
 * File: Index.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Block;

use Magento\Framework\View\Element\Template;

//This is a block class. All the public methods will be accessible in a template.
//This is where the logic required for retrieving data for the view should be kept.
//The template should be responsible only for rendering content.

/**
 * Class Index
 * @package LizardMedia\Sample\Block
 */
class Index extends Template
{
    /**
     * @return string
     */
    public function getString(): string
    {
        return 'a string';
    }
}
