<?php
namespace Ampc\Asaas\Entity;

/**
 * Standard page Notification Entity for Assas
 *
 * @version    1.0
 * @package    API
 * @author     Antonio M P Castro
 * @copyright  Copyright (c) 2023 
 * @license    -
 */


final class Notification extends \Ampc\Asaas\Entity\AbstractEntity
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
    public $event;

    /**
     * @var int
     */
    public $scheduleOffset;

    /**
     * @var bool
     */
    public $emailEnabledForProvider;

    /**
     * @var bool
     */
    public $smsEnabledForProvider;

    /**
     * @var bool
     */
    public $emailEnabledForCustomer;

    /**
     * @var bool
     */
    public $smsEnabledForCustomer;

    /**
     * @var bool
     */
    public $enabled;
}