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

        $customers = json_decode($customers);
     
        if (!empty($customers->erro) or !empty($customers->errors) or ($customers->erro == true)) {

            return $customers;
        }

        $this->extractMeta($customers);

        return array_map(function($customer){

            return new CustomerEntity($customer->customer);

        }, $customers->data);
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

        $customer = json_decode($customer);

        if (!empty($customer->erro) or !empty($customer->errors) or ($customer->erro == true)) {
            return $customer;
        }

        return new CustomerEntity($customer);
    }

    /**
     * Get Customer By Email
     *
     * @param   string  $email  Customer Id
     * @return  CustomerEntity|null
     */
    public function getByEmail($email)
    {
        foreach($this->getAll(['name' => $email]) as $customer){

            if (!empty($customer->erro) or !empty($customer->errors)  or ($customer->erro == true)) {

                return $customer;
            }

            if($customer->email == $email){
                return $customer;
            }
        }

        return;
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

        $customer = json_decode($customer);

        if (!empty($customer->erro) or !empty($customer->errors)) {

            return $customer;
        }


        return new CustomerEntity($customer);
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

        $customer = json_decode($customer);

        if (!empty($customer->erro) or !empty($customer->errors)) {

            return $customer;
        }

        return new CustomerEntity($customer);
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

       json_decode($customer);

       if (!empty($customer->erro) or !empty($customer->errors)) {

            return $customer;
        }

        return ['delete' => true, "id"=>(int) $id];
    }
}