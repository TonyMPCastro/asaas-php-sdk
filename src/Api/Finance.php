<?php
namespace Ampc\Asaas\Api;

/**
 * Standard page City Api for Assas
 *
 * @version    1.0
 * @package    API
 * @author     Antonio M P Castro
 * @copyright  Copyright (c) 2023 
 * @license    -
 */

// Entities
use Ampc\Asaas\Entity\Finance as FinanceEntity;


class Finance extends \Ampc\Asaas\Api\AbstractApi
{
    /**
     * Get all cities
     *
     * @return  FinanceEntity  
     */
    public function getBalance()
    {
        $balance = $this->adapter->get(sprintf('%s/finance/balance', $this->endpoint));

        $balance = json_decode($balance);

        if (!empty($balance->erro) or !empty($balance->errors)) {

            return $balance;
        }
        
        $this->extractMeta($balance);

        return new FinanceEntity($balance);
    }

}