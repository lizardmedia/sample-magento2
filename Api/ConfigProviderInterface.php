<?php
/**
 * File: ConfigProviderInterface.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Api;

//Module API for providing data from the configuration of the module

/**
 * Interface ConfigProviderInterface
 * @package LizardMedia\Sample\Api
 */
interface ConfigProviderInterface
{
    /**
     * @return bool
     */
    public function getBoolValue(): bool;

    /**
     * @return string
     */
    public function getTextValue(): string;
}
