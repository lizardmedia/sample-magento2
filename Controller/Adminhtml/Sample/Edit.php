<?php
/**
 * File: Edit.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Controller\Adminhtml\Sample;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use LizardMedia\Sample\Api\Data\SampleRepositoryInterface;

//Controller for editing a sample. Basically the same as NewAction except for adding
//the requested sample to registry to be able to retrieve it in button classes.

/**
 * Class Edit
 * @package LizardMedia\Sample\Controller\Adminhtml\Sample
 */
class Edit extends AbstractController
{
    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * @var Registry
     */
    private $coreRegistry;

    /**
     * @var SampleRepositoryInterface
     */
    private $sampleRepository;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     * @param SampleRepositoryInterface $sampleRepository
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        SampleRepositoryInterface $sampleRepository
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->coreRegistry = $coreRegistry;
        $this->sampleRepository = $sampleRepository;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $sample = $this->sampleRepository->getById($id);
        $this->coreRegistry->register('sample', $sample);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}
