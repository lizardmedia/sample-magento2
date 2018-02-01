<?php
/**
 * File: Index.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Block;

use LizardMedia\Sample\Api\Data\SampleRepositoryInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Api\SearchCriteriaBuilder;

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
     * @var SampleRepositoryInterface
     */
    private $sampleRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var array
     */
    private $samples;

    /**
     * Index constructor.
     * @param SampleRepositoryInterface $sampleRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        SampleRepositoryInterface $sampleRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->sampleRepository = $sampleRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @return \LizardMedia\Sample\Api\Data\SampleInterface[]
     */
    public function getSamples(): array
    {
        if (!$this->samples) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
            $this->samples = $this->sampleRepository->getList($searchCriteria);
        }
        return $this->samples;
    }
}
