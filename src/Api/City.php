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
use Ampc\Asaas\Entity\City as CityEntity;


class City extends \Ampc\Asaas\Api\AbstractApi
{
    /**
     * Get all cities
     *
     * @param   array  $filters  (optional) Filters Array
     * @return  array  Cities Array
     */
    public function getAll(array $filters = [])
    {
        $cities = $this->adapter->get(sprintf('%s/cities?%s', $this->endpoint, http_build_query($filters)));

        $cities = json_decode($cities);

        if (property_exists($cities, 'erro') or property_exists($cities, 'errors')) {

            return $cities;
        }
        
        $this->extractMeta($cities);

        return array_map(function($city)
        {
            return new CityEntity($city->city);
            
        }, $cities->data);
    }

    /**
     * Get City By Id
     *
     * @param   int  $id  City Id
     * @return  CityEntity
     */
    public function getById($id)
    {
        $city = $this->adapter->get(sprintf('%s/cities/%s', $this->endpoint, $id));

        $city = json_decode($city);

        if (property_exists($city, 'erro') or property_exists($city, 'errors')) {

            return $city;
        }

        return new CityEntity($city);
    }
}