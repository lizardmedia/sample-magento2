<?php
/**
 * File: SampleActions.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

//This is a provider for actions column on the listing. It allows to add custom actions
//for each row of the grid.

/**
 * Class SampleActions
 * @package LizardMedia\Sample\Ui\Component\Listing\Column
 */
class SampleActions extends Column
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')]['edit'] = $this->getEditButtonData($item);
                $item[$this->getData('name')]['delete'] = $this->getDeleteButtonData($item);
            }
        }

        return $dataSource;
    }

    /**
     * @param $item
     * @return array
     */
    private function getEditButtonData($item)
    {
        return [
            'href' => $this->urlBuilder->getUrl(
                'sample/sample/edit',
                ['id' => $item['entity_id']]
            ),
            'label' => __('Edit'),
            'hidden' => false,
        ];
    }

    private function getDeleteButtonData($item)
    {
        return [
            'href' => $this->urlBuilder->getUrl(
                'sample/sample/delete',
                ['id' => $item['entity_id']]
            ),
            'label' => __('Delete'),
            'hidden' => false,
        ];
    }
}
