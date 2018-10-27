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

    protected function createDefaultHttpClient()
    {
        $options = [
            'exceptions' => false,
            'base_uri' => $this->config->getBaseUri(),
            'timeout' => $this->config->getTimeout()
        ];

        return new \GuzzleHttp\Client($options);
    }
}