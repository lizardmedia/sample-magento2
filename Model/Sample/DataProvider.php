<?php
/**
 * File: DataProvider.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Model\Sample;

use LizardMedia\Sample\Model\ResourceModel\Sample\CollectionFactory;
use LizardMedia\Sample\Model\ResourceModel\Sample\Collection;
use Magento\Ui\DataProvider\AbstractDataProvider;

//This is the data provider implementation for the form UI component.

/**
 * Class DataProvider
 * @package LizardMedia\Sample\Model\Sample
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * DataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        /** @var Collection collection */
        $this->collection = $collectionFactory->create();
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $samples = $this->collection->getItems();
        $this->loadedData = [];
        foreach ($samples as $sample) {
            $this->loadedData[$sample->getId()]['sample'] = $sample->getData();
        }

        return $this->loadedData;

    }
}