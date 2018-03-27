<?php
/**
 * File: IndexTest.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Test\Integration\Controller\Index;

use Magento\TestFramework\TestCase\AbstractController;

/**
 * Class IndexTest
 * @package LizardMedia\Sample\Test\Integration\Controller\Index
 */
class IndexTest extends AbstractController
{
    /**
     * Load fixture
     */
    public static function loadSampleFixture()
    {
        require __DIR__ . '/../../_files/SampleFixture.php';
    }

    /**
     * @magentoDbIsolation enabled
     * @magentoAppIsolation enabled
     * @magentoDataFixture loadSampleFixture
     */
    public function testLocationDisplaysData()
    {
        $this->dispatch('sample/');

        $expectedTitle = 'Sample title for sample model';
        $expectedDescription = 'Sample description for sample model';
        $expectedHtmlId = 'sample-grid-container';
        $expectedHttpCode = 200;

        $this->assertEquals($expectedHttpCode, $this->getResponse()->getHttpResponseCode());
        $this->assertContains($expectedTitle, $this->getResponse()->getBody());
        $this->assertContains($expectedDescription, $this->getResponse()->getBody());
        $this->assertContains("id=\"{$expectedHtmlId}\"", $this->getResponse()->getBody());
    }
}
