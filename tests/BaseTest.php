<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 11/6/18
 * Time: 18:42
 */

abstract class BaseTest extends \PHPUnit\Framework\TestCase {
    /** @var \Shippo\Client */
    private $client;

    protected function getClient(): \Shippo\Client {
        if (null == $this->client) {
            $config = new \Shippo\Config([
                'access_token' => '',
                'base_uri' => 'https://sandbox-apix.shippo.vn',
            ]);
            $this->client = new \Shippo\Client($config);
        }

        return $this->client;
    }
}