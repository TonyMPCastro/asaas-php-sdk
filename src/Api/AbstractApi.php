<?php
namespace Ampc\Asaas\Api;

/**
 * Standard page AbstractApi Api for Assas
 *
 * @version    1.0
 * @package    API
 * @author     Antonio M P Castro
 * @copyright  Copyright (c) 2023 
 * @license    -
 */


use Ampc\Asaas\Adapter\AdapterInterface;
use Ampc\Asaas\Entity\Meta;


abstract class AbstractApi
{

    /**
     * Http Adapter Instance
     *
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * Api Endpoint
     *
     * @var string
     */
    protected $endpoint;

    /**
     * @var Meta
     */
    protected $meta;

    /**
     * Constructor
     *
     * @param  AdapterInterface  $adapter   Adapter Instance
     * @param  string            $url  (optional) url da API
     */
    public function __construct(AdapterInterface $adapter, $url){
        
        $this->adapter = $adapter;

        $this->endpoint = $url;
    }

    /**
     * Extract results meta
     *
     * @param   \stdClass  $data  Meta data
     * @return  Meta
     */
    protected function extractMeta(\StdClass $data)
    {
        $this->meta = new Meta($data);

        return $this->meta;
    }

    /**
     * Return results meta
     *
     * @return  Meta
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Get Generic All object
     *
     * @param   string  $datas_receve  Data to get api
     * @param   string  $class  Class of object
     * @param   string  $var  Var where to object
     * @return  object|array|null
     */
    public function resultGetAll($datas_receve, $class, $var )
    {   
        $objects_return = [];

        if(!empty($datas_receve))
        {
            $objects_receve = json_decode($datas_receve);

            if(is_object($objects_receve))
            {
                if (property_exists($objects_receve, 'erro') or property_exists($objects_receve, 'errors')) {
                    return $objects_return;
                }

                $this->extractMeta($objects_receve);

                $objects_return =  array_map(function($object) use ($class, $var){

                    return new $class($object->$var);

                }, $objects_receve->data);

            }
        }

        return $objects_return;
    }

    /**
     * Get Generic All object
     *
     * @param   string  $datas_receve  
     * @param   string  $class 
     * @return  object|array|null
     */
    public function resultGenericObject($datas_receve, $class)
    {   
        $objects_return = null;

        if(!empty($datas_receve))
        {
            $objects_receve = json_decode($datas_receve);

            if(is_object($objects_receve))
            {
                if (property_exists($objects_receve, 'erro') or 
                    property_exists($objects_receve, 'errors')) {
                    return $objects_return;
                }

                $objects_return = new $class($objects_receve);
            }
        }
        
        return $objects_return;
    }
}