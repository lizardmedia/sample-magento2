<?php
/**
 * File: ModuleConfigTest.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Test\Integration;

use PHPUnit\Framework\TestCase;
use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Module\ModuleList;
use Magento\TestFramework\Helper\Bootstrap;

/**
 * Class ModuleConfigTest
 * @package LizardMedia\Sample\Test\Integration
 */
class ModuleConfigTest extends TestCase
{
    const MODULE_NAME = 'LizardMedia_Sample';

    /**
     * @test
     */
    public function testTheModuleIsRegistered()
    {
        $registrar = new ComponentRegistrar();
        $this->assertArrayHasKey(self::MODULE_NAME, $registrar->getPaths(ComponentRegistrar::MODULE));
    }

    /**
     * @test
     */
    public function testTheModuleIsConfiguredAndEnabled()
    {
        $objectManager = Bootstrap::getObjectManager();
        $moduleList = $objectManager->create(ModuleList::class);
        $this->assertTrue($moduleList->has(self::MODULE_NAME));
    }
}
