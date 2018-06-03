<?php
/**
 * File: SampleExtensionAttribute.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Model\Data;

use LizardMedia\Sample\Api\Data\SampleExtensionAttributeInterface;
use LizardMedia\Sample\Api\Data\SampleInterface;

/**
 * Class SampleExtensionAttribute
 * @package LizardMedia\Sample\Model\Data
 */
class SampleExtensionAttribute implements SampleExtensionAttributeInterface
{
    /**
     * @var SampleInterface|null
     */
    private $value;

    /**
     * @return SampleInterface|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param SampleInterface $sample
     * @return void
     */
    public function setValue(SampleInterface $sample)
    {
        $this->value = $sample;
    }
}
