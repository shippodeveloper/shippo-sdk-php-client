<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 10/27/18
 * Time: 16:45
 */

namespace Shippo\Endpoints;


use Shippo\Client;

abstract class BaseEndpoint
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * BaseEndpoint constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Check is 2xx http status
     *
     * @param int $statusCode
     * @return bool
     */
    protected function is2xxHttpStatus(int $statusCode): bool
    {
        return $statusCode >= 200 && $statusCode < 300;
    }
}