<?php
/**
 * File: ProductResource.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Plugin;

use Magento\Catalog\Model\ResourceModel\Product;
use Magento\Framework\Model\AbstractModel;
use Psr\Log\LoggerInterface;

//Plugin class that extends the product resource and makes changes before, after and around the
//save method.

/**
 * Class ProductResource
 * @package LizardMedia\Sample\Plugin
 */
class ProductResource
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * ProductSaveController constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param Product $subject
     * @param AbstractModel $object
     * @return array
     */
    public function beforeSave(Product $subject, AbstractModel $object): array
    {
        $this->logger->info('Before plugin called');
        return [$object];
    }

    /**
     * @param Product $subject
     * @param $result
     * @return mixed
     */
    public function afterSave(Product $subject, $result)
    {
        $this->logger->info('After plugin called');
        return $result;
    }

    /**
     * @param Product $subject
     * @param callable $proceed
     * @param AbstractModel $object
     * @return mixed
     */
    public function aroundSave(Product $subject, callable $proceed, AbstractModel $object)
    {
        $this->logger->info('Around plugin called');
        return $proceed($object);
    }
}
