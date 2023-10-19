<?php
namespace Ampc\Asaas\Entity;

/**
 * Standard page Finance Entity for Assas
 *
 * @version    1.0
 * @package    API
 * @author     Antonio M P Castro
 * @copyright  Copyright (c) 2023 
 * @license    -
 */

 final class Finance extends \Ampc\Asaas\Entity\AbstractEntity
{
    /**
     * @var double
     */
    public $balance;

    /**
     * @var int
     */
    public $quantity;

    /**
     * @var double
     */
    public $value;

    /**
     * @var double
     */
    public $netValue;

    /**
     * @var double
     */
    public $income;

    /**
     * @var int
     */
    public $outcome;

}