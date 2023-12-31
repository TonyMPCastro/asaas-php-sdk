<?php
namespace Ampc\Asaas\Adapter;

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

// GuzzleHttp
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;


class GuzzleHttpAdapter implements AdapterInterface
{
    /**
     * Client Instance
     *
     * @var ClientInterface
     */
    protected $client;

    /**
     * Command Response
     *
     * @var \GuzzleHttp\Psr7\Response|\Psr\Http\Message\ResponseInterface
     */
    protected $response;

    /**
     * Constructor
     *
     * @param  string                $token   Access Token
     * @param  ClientInterface|null  $client  Client Instance
     */
    public function __construct($token, ClientInterface $client = null){
        
        if(version_compare(ClientInterface::MAJOR_VERSION, '6') === 1){
            
            $this->client = $client ?: new Client(['headers' => ['access_token' => $token]]);
            
        }else{
            
            $this->client = $client ?: new Client();

            $this->client->setDefaultOption('headers/access_token', $token);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function get($url){
        try{
            
            $this->response = $this->client->get($url);
            
        }catch(RequestException $e){
            
            $this->response = $e->getResponse();

            $this->handleError();
        }

        return $this->response->getBody();
    }



    /**
     * {@inheritdoc}
     */
    public function delete($url){
        
        try{
            
            $this->response = $this->client->delete($url);
            
        }catch(RequestException $e){
            
            $this->response = $e->getResponse();

            $this->handleError();
        }

        return $this->response->getBody();
    }

    /**
     * {@inheritdoc}
     */
    public function put($url, $content = ''){
        
        $options = [];
        $options['body'] = $content;

        try{
            
            $this->response = $this->client->put($url, $options);
            
        }catch(RequestException $e){
            
            $this->response = $e->getResponse();

            $this->handleError();
        }

        return $this->response->getBody();
    }

    /**
     * {@inheritdoc}
     */
    public function post($url, $content = ''){
        
        $options = [];
        
        $options['form_params'] = $content;

        try{
            
            $this->response = $this->client->post($url, $options);
            
        }catch(RequestException $e){
            
            $this->response = $e->getResponse();

            $this->handleError();
        }

        return $this->response->getBody();
    }

    /**
     * {@inheritdoc}
     */
    public function getLatestResponseHeaders(){
        
        if(null === $this->response){
            
            return;
        }

        return [
            'reset'     => (int) (string) $this->response->getHeader('RateLimit-Reset'),
            'remaining' => (int) (string) $this->response->getHeader('RateLimit-Remaining'),
            'limit'     => (int) (string) $this->response->getHeader('RateLimit-Limit'),
        ];
    }


    protected function handleError(){
        
        $body = (string) $this->response->getBody();
        
        $code = (int) $this->response->getStatusCode();

        $content = json_decode($body);

        $message = isset($content->message) ? $content->message :'';

        return json_encode(['erro'=>true, 'code'=>$code,'message'=>$message,'body'=>$body]);
    }
}