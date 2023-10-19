<?php
namespace Ampc\Asaas;

/**
 * Standard page Assas
 *
 * @version    1.0
 * @package    Adapter
 * @author     Antonio M P Castro
 * @copyright  Copyright (c) 2023 
 * @license    -
 */

// Exception by Adianti-framework
use Exception;


// API's
use Ampc\Asaas\Adapter\GuzzleHttpAdapter;
use Ampc\Asaas\Adapter\AdapterInterface;
use Ampc\Asaas\Api\Customer;
use Ampc\Asaas\Api\Subscription;
use Ampc\Asaas\Api\Payment;
use Ampc\Asaas\Api\Notification;
use Ampc\Asaas\Api\City;
use Ampc\Asaas\Api\Finance;

class Asaas{
    /**
     * Adapter Interface
     *
     * @var  AdapterInterface
     */
    protected $adapter;

    /**
     * Ambiente da API
     *
     * @var  string
     */
    protected $ambiente;

    /**
     * Constructor
     *
     * @param  string                $token   Access Token
     * @param  string            $ambiente  (optional) Ambiente da API
     */
    public function __construct($token, $ambiente = 'producao'){

        $adapter = new GuzzleHttpAdapter($token);

        $this->adapter = $adapter;

        $this->ambiente = $ambiente;
    }

    /**
     * Get customer endpoint
     *
     * @return  Customer
     */
    public function customer()
    {
        return new Customer($this->adapter, $this->ambiente);
    }

    /**
     * Get subscription endpoint
     *
     * @return  Subscription
     */
    public function subscription()
    {
        return new Subscription($this->adapter, $this->ambiente);
    }

    /**
     * Get payment endpoint
     *
     * @return  Payment
     */
    public function payment()
    {
        return new Payment($this->adapter, $this->ambiente);
    }

    /**
     * Get Notification API Endpoint
     *
     * @return  Notification
     */
    public function notification()
    {
        return new Notification($this->adapter, $this->ambiente);
    }

    /**
     * Get city endpoint
     *
     * @return  City
     */
    public function city()
    {
        return new City($this->adapter, $this->ambiente);
    }


       /**
     * Get city endpoint
     *
     * @return  Finance
     */
    public function finance()
    {
        return new Finance($this->adapter, $this->ambiente);
    }
}