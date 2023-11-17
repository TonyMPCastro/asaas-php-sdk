<?php

namespace Ampc\Asaas\Api;

/**
 * Standard page Installments Api for Assas
 *
 * @version    1.0
 * @package    API
 * @author     Antonio M P Castro
 * @copyright  Copyright (c) 2023 
 * @license    -
 */


 
// Entities
use Ampc\Asaas\Entity\Installments as InstallmentsEntity;

class Installments extends \Ampc\Asaas\Api\AbstractApi
{

     /**
     * Get all Installments
     *
     * @param   array  $filters  (optional) Filters Array
     * @return  array  Installments Array
     */
    public function getAll(array $filters = [])
    {
        $installments = $this->adapter->get(sprintf('%s/installments?%s', $this->endpoint, http_build_query($filters)));

        $installments = json_decode($installments);

        if (property_exists($installments, 'erro') or property_exists($installments, 'errors')) {

            return $installments;
        }

        $this->extractMeta($installments);

        return array_map(function($installment){

            return new InstallmentsEntity($installment);
            
        }, $installments->data);
    }


     /**
     * Get Installments By Id
     *
     * @param   int  $id  Installments Id
     * @return  InstallmentsEntity
     */
    public function getById($id)
    {
        $installment = $this->adapter->get(sprintf('%s/installments/%s', $this->endpoint, $id));

        $installment = json_decode($installment);

        if (property_exists($installment, 'erro') or property_exists($installment, 'errors')) {

            return $installment;
        }

        return new InstallmentsEntity($installment);
    }


    /**
     * Get Payment Book Installments By Id
     *
     * @param   int  $id  Installments Id
     * @return  InstallmentsEntity
     */
    public function getPaymentBookById($id)
    {
        $installment = $this->adapter->get(sprintf('%s/installments/%s/paymentBook', $this->endpoint, $id));

        $installment = json_decode($installment);

        if (property_exists($installment, 'erro') or property_exists($installment, 'errors')) {

            return $installment;
        }

        return new InstallmentsEntity($installment);
    }




    
}