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
                'access_token' => 'a86988bfe20d23e54b53af8ea1140f98c6233dce',
                'base_uri' => 'https://sandbox-apix.shippo.vn',
            ]);
            $this->client = new \Shippo\Client($config);
        }

        return $this->client;
    }
}