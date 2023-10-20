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
     * url da API
     *
     * @var  string
     */
    protected $url;

    /**
     * Constructor
     *
     * @param  string                $token   Access Token
     * @param  string            $url  (optional) url da API
     */
    public function __construct($token, $url = 'https://sandbox.asaas.com/api/v3'){

        $adapter = new GuzzleHttpAdapter($token);

        $this->adapter = $adapter;

        $this->url = $url;
    }

    /**
     * Get customer endpoint
     *
     * @return  Customer
     */
    public function customer()
    {
        return new Customer($this->adapter, $this->url);
    }

    /**
     * Get subscription endpoint
     *
     * @return  Subscription
     */
    public function subscription()
    {
        return new Subscription($this->adapter, $this->url);
    }

    /**
     * Get payment endpoint
     *
     * @return  Payment
     */
    public function payment()
    {
        return new Payment($this->adapter, $this->url);
    }

    /**
     * Get Notification API Endpoint
     *
     * @return  Notification
     */
    public function notification()
    {
        return new Notification($this->adapter, $this->url);
    }

    /**
     * Get city endpoint
     *
     * @return  City
     */
    public function city()
    {
        return new City($this->adapter, $this->url);
    }


       /**
     * Get city endpoint
     *
     * @return  Finance
     */
    public function finance()
    {
        return new Finance($this->adapter, $this->url);
    }
}