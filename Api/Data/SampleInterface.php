<?php
/**
 * File: SampleInterface.php
 *
 * @author      Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * Github:      https://github.com/maciejslawik
 */

namespace LizardMedia\Sample\Api\Data;

//This is the data interface of the module.
//It provides consistent API for the model.

/**
 * Interface SampleInterface
 * @package LizardMedia\Sample\Api\Data
 */
interface SampleInterface
{
    const ID = 'entity_id';
    const TITLE = 'title';
    const DESCRIPTION = 'description';
    const QUOTE_ID = 'quote_id';
    const ORDER_ID = 'order_id';

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return void
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void;

    /**
     * @return int|null
     */
    public function getQuoteId();

    /**
     * @param int|null $id
     * @return void
     */
    public function setQuoteId($id): void;

    /**
     * @return int|null
     */
    public function getOrderId();

    /**
     * @param int|null $id
     * @return void
     */
    public function setOrderId($id): void;
}
