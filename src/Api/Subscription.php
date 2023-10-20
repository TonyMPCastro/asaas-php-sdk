<?php
namespace Ampc\Asaas\Api;

/**
 * Standard page Subscription Api for Assas
 *
 * @version    1.0
 * @package    API
 * @author     Antonio M P Castro
 * @copyright  Copyright (c) 2023 
 * @license    -
 */



// Entities
use Ampc\Asaas\Entity\Subscription as SubscriptionEntity;

class Subscription extends \Ampc\Asaas\Api\AbstractApi{
    /**
     * Get all subscriptions
     *
     * @param   array  $filters  (optional) Filters Array
     * @return  array  Subscriptions Array
     */
    public function getAll(array $filters = [])
    {
        $subscriptions = $this->adapter->get(sprintf('%s/subscriptions?%s', $this->endpoint, http_build_query($filters)));

        $subscriptions = json_decode($subscriptions);
        
        if (!empty($subscriptions->erro) or ($subscriptions->erro == true)) {

            return $subscriptions;
        }

        $this->extractMeta($subscriptions);

        return array_map(function($subscription)
        {
            return new SubscriptionEntity($subscription->subscription);
        }, $subscriptions->data);
    }

    /**
     * Get Subscription By Id
     *
     * @param   int  $id  Subscription Id
     * @return  SubscriptionEntity
     */
    public function getById($id)
    {
        $subscription = $this->adapter->get(sprintf('%s/subscriptions/%s', $this->endpoint, $id));

        $subscription = json_decode($subscription);
        
        if (!empty($subscription->erro) or ($subscription->erro == true)) {

            return $subscription;
        }

        return new SubscriptionEntity($subscription);
    }

    /**
     * Get Subscriptions By Customer Id
     *
     * @param   int  $customerId  Customer Id
     * @param   array  $filters  (optional) Filters Array
     * @return  SubscriptionEntity[]
     */
    public function getByCustomer($customerId,array $filters = [])
    {
        $subscriptions = $this->adapter->get(sprintf('%s/customers/%s/subscriptions?%s', $this->endpoint, $customerId, http_build_query($filters)));

        $subscriptions = json_decode($subscriptions);

        if (!empty($subscriptions->erro) or ($subscriptions->erro == true)) {

            return $subscriptions;
        }

        $this->extractMeta($subscriptions);

        return array_map(function($subscription)
        {
            return new SubscriptionEntity($subscription->subscription);
        }, $subscriptions->data);
    }

    /**
     * Create new subscription
     *
     * @param   array  $data  Subscription Data
     * @return  SubscriptionEntity
     */
    public function create(array $data)
    {
        $subscription = $this->adapter->post(sprintf('%s/subscriptions', $this->endpoint), $data);

        $subscription = json_decode($subscription);
        
        if (!empty($subscription->erro) or ($subscription->erro == true)) {

            return $subscription;
        }

        return new SubscriptionEntity($subscription);
    }

    /**
     * Update Subscription By Id
     *
     * @param   string  $id    Subscription Id
     * @param   array   $data  Subscription Data
     * @return  SubscriptionEntity
     */
    public function update($id, array $data)
    {
        $subscription = $this->adapter->post(sprintf('%s/subscriptions/%s', $this->endpoint, $id), $data);

        $subscription = json_decode($subscription);
        
        if (!empty($subscription->erro) or ($subscription->erro == true)) {

            return $subscription;
        }

        return new SubscriptionEntity($subscription);
    }

    /**
     * Delete Subscription By Id
     *
     * @param  string|int  $id  Subscription Id
     */
    public function delete($id)
    {
        $subscription = $this->adapter->delete(sprintf('%s/subscriptions/%s', $this->endpoint, $id));

        $subscription = json_decode($subscription);

        if (!empty($subscription->erro) or ($subscription->erro == true)) {

            return $subscription;
        }

        return ['delete' => true, "id"=>(int) $id];
    }
}