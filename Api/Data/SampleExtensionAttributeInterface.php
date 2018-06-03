<?php
/**
 * File: SampleExtensionAttributeInterface.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Api\Data;

/**
 * Interface SampleExtensionAttributeInterface
 * @package LizardMedia\Sample\Api\Data
 */
interface SampleExtensionAttributeInterface
{
    /**
     * @return SampleInterface|null
     */
    public function getValue();

    /**
     * @param SampleInterface $sample
     * @return void
     */
    public function setValue(SampleInterface $sample);
}
