<?php
namespace AMPC\Asaas\Adapter;
/**
 * Standard page Adapter for Assas
 *
 * @version    1.0
 * @package    Adapter
 * @author     Antonio M P Castro
 * @copyright  Copyright (c) 2023 
 * @license    -
 */

// Exception by Adianti-framework
use Exception;

interface AdapterInterface{
    /**
     * GET Request
     *
     * @param   string  $url  Request Url
     * @throws  Exception
     * @return  string
     */
    public function get($url);

    /**
     * DELETE Request
     *
     * @param   string  $url  Request Url
     * @throws  Exception
     */
    public function delete($url);

    /**
     * PUT Request
     *
     * @param   string  $url      Request Url
     * @param   mixed   $content  Request Content
     * @throws  Exception
     * @return  string
     */
    public function put($url, $content = '');

    /**
     * POST Request
     *
     * @param   string  $url      Request Url
     * @param   mixed   $content  Request Content
     * @throws  Exception
     * @return  string
     */
    public function post($url, $content = '');

    /**
     * Get last response headers
     *
     * @return array|null
     */
    public function getLatestResponseHeaders();
}