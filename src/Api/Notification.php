<?php
namespace Ampc\Asaas\Api;

/**
 * Standard page Notification Api for Assas
 *
 * @version    1.0
 * @package    API
 * @author     Antonio M P Castro
 * @copyright  Copyright (c) 2023 
 * @license    -
 */



// Entities
use Ampc\Asaas\Entity\Notification as NotificationEntity;


class Notification extends \Ampc\Asaas\Api\AbstractApi
{
    /**
     * Get all notifications
     *
     * @param   array  $filters  (optional) Filters Array
     * @return  array
     */
    public function getAll(array $filters = [])
    {
        $notifications = $this->adapter->get(sprintf('%s/notifications?%s', $this->endpoint, http_build_query($filters)));

        $notifications = json_decode($notifications);

        if (!empty($notifications->erro) or !empty($notifications->errors) or ($notifications->erro == true)) {

            return $notifications;
        }

        $this->extractMeta($notifications);

        return array_map(function($notification){

            return new NotificationEntity($notification);

        }, $notifications->data);
    }

    /**
     * Get Notification By Id
     *
     * @param   int  $id  Notification's Id
     * @return  NotificationEntity
     */
    public function getById($id)
    {
        $notification = $this->adapter->get(sprintf('%s/notifications/%s', $this->endpoint, $id));

        $notification = json_decode($notification);

        if (!empty($notification->erro) or !empty($notification->errors) or ($notification->erro == true)) {

            return $notification;
        }

        return new NotificationEntity($notification->customer);
    }

    /**
     * Get Notifications By Customer Id
     *
     * @param   int    $id       Customer Id
     * @param   array  $filters  (optional) Filters Array
     * @return  array
     */
    public function getByCustomer($customerId, array $filters = [])
    {
        $notifications = $this->adapter->get(sprintf('%s/customers/%s/notifications?%s', $this->endpoint, $customerId, http_build_query($filters)));

        $notifications = json_decode($notifications);

        if (!empty($notifications->erro) or !empty($notifications->errors) or ($notifications->erro == true)) {

            return $notifications;
        }

        $this->extractMeta($notifications);

        return array_map(function($notification)
        {
            return new NotificationEntity($notification->notification);
        }, $notifications->data);
    }

    /**
     * Create New Notification
     *
     * @param   array  $data  Notification's Data
     * @return  NotificationEntity
     */
    public function create(array $data)
    {
        $notification = $this->adapter->post(sprintf('%s/notifications', $this->endpoint), $data);

        $notification = json_decode($notification);

        if (!empty($notification->erro) or !empty($notification->errors) or ($notification->erro == true)) {

            return $notification;
        }

        return new NotificationEntity($notification);
    }

    /**
     * Update Notification By Id
     *
     * @param   string  $id    Notification's Id
     * @param   array   $data  Notification's Data
     * @return  NotificationEntity
     */
    public function update($id, array $data)
    {
        $notification = $this->adapter->post(sprintf('%s/notifications/%s', $this->endpoint, $id), $data);

        $notification = json_decode($notification);

        if (!empty($notification->erro) or !empty($notification->errors) or ($notification->erro == true)) {

            return $notification;
        }

        return new NotificationEntity($notification);
    }

    /**
     * Delete Notification By Id
     *
     * @param  string|int  $id  Notification's Id
     * @return  array
     */
    public function delete($id)
    {
        $notification = $this->adapter->delete(sprintf('%s/notifications/%s', $this->endpoint, $id));

        $notification = json_decode($notification);

        if (!empty($notification->erro) or !empty($notification->errors)  or ($notification->erro == true)) {

            return $notification;
        }

        return ['delete' => true, "id"=>(int) $id];
    }
}