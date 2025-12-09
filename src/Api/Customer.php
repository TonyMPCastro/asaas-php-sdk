<?php
namespace Ampc\Asaas\Api;

/**
 * Standard page Customer Api for Assas
 *
 * @version    1.0
 * @package    Adapter
 * @author     Antonio M P Castro
 * @copyright  Copyright (c) 2023 
 * @license    -
 */

// Entities
use Ampc\Asaas\Entity\Customer as CustomerEntity;


class Customer extends \Ampc\Asaas\Api\AbstractApi
{
    /**
     * Get all customers
     *
     * @param   array  $filters  (optional) Filters Array
     * @return  array  Customers Array
     */
    public function getAll(array $filters = [])
    {
        $customers = $this->adapter->get(sprintf('%s/customers?%s', $this->endpoint, http_build_query($filters)));

        /*
        $customers = json_decode($customers);
     
        if (empty($customers) or property_exists($customers, 'erro') or property_exists($customers, 'errors')) {

            return $customers;
        }

        $this->extractMeta($customers);

        return array_map(function($customer){

            return new CustomerEntity($customer->customer);

        }, $customers->data);

        */

        return $this->resultGetAll($customers, "CustomerEntity", "customer" );
    }

    /**
     * Get Customer By Id
     *
     * @param   int  $id  Customer Id
     * @return  CustomerEntity
     */
    public function getById($id)
    {
        $customer = $this->adapter->get(sprintf('%s/customers/%s', $this->endpoint, $id));

        /*
        $customer = json_decode($customer);

        if (empty($customer) or property_exists($customer, 'erro') or property_exists($customer, 'errors')) {
            return $customer;
        }

        return new CustomerEntity($customer);

        */

        return $this->resultGenericObject($customer, "CustomerEntity");
    }

    /**
     * Get Customer By Email
     *
     * @param   string  $email  Customer Id
     * @return  CustomerEntity|null
     */
    public function getByEmail($email)
    {   
        $customers = $this->getAll(['name' => $email]);

        $customers_ret = $this->resultGetAll($customers, "CustomerEntity", "customer" );
        
        $customer_ret = null;

        if(is_array($customers_ret))
        {
            foreach($customers_ret as $customer)
            {
                if(is_object($customer))
                {
                    if($customer->email == $email)
                    {
                        $customer_ret = $customer;
                    }
                }
            } 
        }
        
        return $customer_ret;
    }

    /**
     * Create new customer
     *
     * @param   array  $data  Customer Data
     * @return  CustomerEntity
     */
    public function create(array $data)
    {
        $customer = $this->adapter->post(sprintf('%s/customers', $this->endpoint), $data);
        /*
        $customer = json_decode($customer);

        if (empty($customer) or property_exists($customer, 'erro') or property_exists($customer, 'errors')) {

            return $customer;
        }

        return new CustomerEntity($customer);
        */
        return $this->resultGenericObject($customer, "CustomerEntity");

    }

    /**
     * Update Customer By Id
     *
     * @param   string  $id    Customer Id
     * @param   array   $data  Customer Data
     * @return  CustomerEntity
     */
    public function update($id, array $data)
    {
        $customer = $this->adapter->post(sprintf('%s/customers/%s', $this->endpoint, $id), $data);
        /*
        $customer = json_decode($customer);

        if (empty($customer) or property_exists($customer, 'erro') or property_exists($customer, 'errors')) {

            return $customer;
        }

        return new CustomerEntity($customer);
        */
        return $this->resultGenericObject($customer, "CustomerEntity");

    }

    /**
     * Delete Customer By Id
     *
     * @param  string|int  $id  Customer Id
     * @return  array
     */
    public function delete($id)
    {
       $customer = $this->adapter->delete(sprintf('%s/customers/%s', $this->endpoint, $id));

       $customer = json_decode($customer);

       if (empty($customer) or property_exists($customer, 'erro') or property_exists($customer, 'errors')) {

            return $customer;
        }

        return ['delete' => true, "id"=>(int) $id];
    }
}