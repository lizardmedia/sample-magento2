<?php
/**
 * File: SampleFixture.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

/** @var \LizardMedia\Sample\Api\Data\SampleInterface $sample */
$sample = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()
    ->create('LizardMedia\Sample\Api\Data\SampleInterface');

/** @var \LizardMedia\Sample\Api\Data\SampleRepositoryInterface $sampleRepository */
$sampleRepository = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()
    ->create('LizardMedia\Sample\Api\Data\SampleRepositoryInterface');

$sample->setTitle('Sample title for sample model');
$sample->setDescription('Sample description for sample model');

$sampleRepository->save($sample);
