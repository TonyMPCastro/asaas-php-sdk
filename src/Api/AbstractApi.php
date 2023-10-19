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
     * Endpoint Produção
     *
     * @var string
     */
    const ENDPOINT_PRODUCAO = 'https://api.asaas.com/v3';

    /**
     * Endpoint Homologação
     *
     * @var string
     */
    const ENDPOINT_HOMOLOGACAO = 'https://sandbox.asaas.com/api/v3';

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
     * @param  string            $ambiente  (optional) Ambiente da API
     */
    public function __construct(AdapterInterface $adapter, $ambiente = 'producao')
    {
        $this->adapter = $adapter;

        $this->endpoint = $ambiente == 'homologacao' ? static::ENDPOINT_HOMOLOGACAO : static::ENDPOINT_PRODUCAO;
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
}