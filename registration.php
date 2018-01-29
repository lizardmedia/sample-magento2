<?php
/**
 * File: registration.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github       https://github.com/maciejslawik
 */

//This registers the module in autoloading
\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    'LizardMedia_Sample',
    __DIR__
);
