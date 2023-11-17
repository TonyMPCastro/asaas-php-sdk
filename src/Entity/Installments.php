<?php

namespace Ampc\Asaas\Entity;

/**
 * Standard page Installments Entity for Assas
 *
 * @version    1.0
 * @package    API
 * @author     Antonio M P Castro
 * @copyright  Copyright (c) 2023 
 * @license    -
 */

class Installments extends \Ampc\Asaas\Entity\AbstractEntity
{

    /**
     * @var int
     */
    public $id;

    /**
     * @var string

     */
    public $customer;

       /**
     * @var string
     */
    public $paymentDate;

       /**
     * @var string
     */
    public $installment ;


    
}