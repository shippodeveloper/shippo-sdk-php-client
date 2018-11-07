<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 10/27/18
 * Time: 15:45
 */

namespace Shippo;


use GuzzleHttp\ClientInterface;

class Client
{
    /**
     * @var Config
     */
    private $config;
    /**
     * @var ClientInterface
     */
    private $http;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @return ClientInterface
     */
    public function getHttp(): ClientInterface
    {
        if (null === $this->http) {
            $this->http = $this->createDefaultHttpClient();
        }
        return $this->http;
    }


    protected function createDefaultHttpClient(): \GuzzleHttp\Client
    {
        $options = [
            'exceptions' => false,
            'base_uri' => $this->config->getBaseUri(),
            'timeout' => $this->config->getTimeout(),
            'headers' => [
                'Authorization' => 'Bearer ' .$this->config->getAccessToken(),
                'Content-Type' => 'application/json'
            ]
        ];

        return new \GuzzleHttp\Client($options);
    }
}