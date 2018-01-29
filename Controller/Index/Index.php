<?php
/**
 * File: Index.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

//The route of the controller is /sample/index/index
//Parts of the URL:
//1. The front name of the module defined in etc/frontend/routes.xml
//2. The namespace of the controller - in this case index. If you put the controller into more folders,
//thus creating a longer namespace, the 2nd part of the URL will be the additional folder names in lowercase separated
//with an underscore, e.g. for namespace LizardMedia\Sample\Controller\Index\Secondindex the 2nd part of the URL
//would be index_secondindex
//3. The name of the controller
//
//If you use the name "Index" as namespace and controller name, you can omit them in the URL and go to /sample

/**
 * Class Index
 * @package LizardMedia\Sample\Controller\Index
 */
class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
//        Result page factory was injected into the controller.
//        We use the factory to create a page and return it.
//        By default the result page will be generated using layout file
//        defined for the route.
        $page = $this->resultPageFactory->create();
        return $page;

//        You can, instead of returning a result page, create a result forward page
//        to redirect the user to a desired URL.
    }
}
