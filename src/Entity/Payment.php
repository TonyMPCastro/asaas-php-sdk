<?php
namespace Ampc\Asaas\Entity;

/**
 * Standard page Payment Entity for Assas
 *
 * @version    1.0
 * @package    API
 * @author     Antonio M P Castro
 * @copyright  Copyright (c) 2023 
 * @license    -
 */


final class Payment extends \Ampc\Asaas\Entity\AbstractEntity
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
    public $subscription;

    /**
     * @var string
     */
    public $billingType;

    /**
     * @var float
     */
    public $value;

    /**
     * @var float
     */
    public $netValue;

    /**
     * @var float
     */
    public $originalValue;

    /**
     * @var float
     */
    public $interestValue;

     /**
     * @var object
     */
    public $discount;


     /**
     * @var object
     */
    public $fine;


     /**
     * @var object
     */
    public $interest;


    /**
     * @var float
     */
    public $grossValue;

    /**
     * @var string
     */
    public $dueDate;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $nossoNumero;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $invoiceNumber;

    /**
     * @var string
     */
    public $invoiceUrl;

    /**
     * @var string
     */
    public $boletoUrl;

    /**
     * @var string
     */
    public $barCode;

    /**
     * @var string
     */
    public $identificationField;

    /**
     * @var int
     */
    public $installmentCount;

    /**
     * @var float
     */
    public $installmentValue;

    /**
     * @var string
     */
    public $creditCardHolderName;

    /**
     * @var string
     */
    public $creditCardNumber;

    /**
     * @var string
     */
    public $paymentDate;

    
    /**
     * @var string
     */
    public $dateCreated;

       /**
     * @var string
     */
    public $installment ;

       /**
     * @var string
     */
    public $bankSlipUrl;

         /**
     * @var string
     */
    public $confirmedDate;

        /**
     * @var string
     */
    public $clientPaymentDate;

    /**
     * @var string
     */
    public $creditCardExpiryMonth;

    /**
     * @var string
     */
    public $creditCardExpiryYear;

    /**
     * @var string
     */
    public $creditCardCcv;

    /**
     * @var string
     */
    public $creditCardHolderFullName;

    /**
     * @var string
     */
    public $creditCardHolderEmail;

    /**
     * @var string
     */
    public $creditCardHolderCpfCnpj;

    /**
     * @var string
     */
    public $creditCardHolderAddress;

    /**
     * @var string
     */
    public $creditCardHolderAddressNumber;

    /**
     * @var string
     */
    public $creditCardHolderAddressComplement;

    /**
     * @var string
     */
    public $creditCardHolderProvince;

    /**
     * @var string
     */
    public $creditCardHolderCity;

    /**
     * @var string
     */
    public $creditCardHolderUf;

    /**
     * @var string
     */
    public $creditCardHolderPostalCode;

    /**
     * @var string
     */
    public $creditCardHolderPhone;

    /**
     * @var string
     */
    public $creditCardHolderPhoneDDD;

    /**
     * @var string
     */
    public $creditCardHolderMobilePhone;

    /**
     * @var string
     */
    public $creditCardHolderMobilePhoneDDD;


      /**
     * @var string
     */
    public $originalDueDate;

    /**
     * @param  string  $dueDate
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = static::convertDateTime($dueDate);
    }
}