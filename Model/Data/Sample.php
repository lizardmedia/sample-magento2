<?php
/**
 * File: Sample.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Model\Data;

use LizardMedia\Sample\Api\Data\SampleInterface;
use Magento\Framework\Api\AbstractExtensibleObject;

//This is the data object for the module.

/**
 * Class Sample
 * @package LizardMedia\Sample\Model\Data
 */
class Sample extends AbstractExtensibleObject implements SampleInterface
{
    /**
     * @return int
     */
    public function getId(): int
    {
        return (int)$this->_get(self::ID);
    }

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->setData(self::ID, $id);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return (string)$this->_get(self::TITLE);
    }

    /**
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->setData(self::TITLE, $title);
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return (string)$this->_get(self::DESCRIPTION);
    }

    /**
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * @return int|null
     */
    public function getQuoteId()
    {
        return $this->_get(self::QUOTE_ID);
    }

    /**
     * @param int|null $id
     * @return void
     */
    public function setQuoteId($id): void
    {
        $this->setData(self::QUOTE_ID, $id);
    }

    /**
     * @return int|null
     */
    public function getOrderId()
    {
        return $this->_get(self::ORDER_ID);
    }

    /**
     * @param int|null $id
     * @return void
     */
    public function setOrderId($id): void
    {
        $this->setData(self::ORDER_ID, $id);
    }
}
