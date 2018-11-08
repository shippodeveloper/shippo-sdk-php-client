<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 11/5/18
 * Time: 10:55
 */

namespace ShippoSDK\Endpoints;


use ShippoSDK\Client;
use ShippoSDK\Exception;
use ShippoSDK\Models\DeliveryOrder;

class DeliveryOrderEndpoint extends BaseEndpoint
{
    private $endpointUrl = '/my/delivery_order';

    public function __construct(Client $client)
    {
        parent::__construct($client);
    }

    public function get() {
    }

    public function create($param = []) {
        $response = $this->client->getHttp()->request('POST', $this->endpointUrl, [
            'json' => $param
        ]);

        if (!$this->is2xxHttpStatus($response->getStatusCode())) {
            throw new Exception($response->getBody()->getContents(), $response->getStatusCode());
        }

        $body = \GuzzleHttp\json_decode($response->getBody(), true);
        return new DeliveryOrder($body);
    }

    public function detail($code) {
        $endpoint = $this->endpointUrl .'/' .$code;

        $response = $this->client->getHttp()->request('GET', $endpoint);
        if ($response->getStatusCode() != 200) {
            throw new Exception($response->getBody()->getContents(), $response->getStatusCode());
        }

        $body = \GuzzleHttp\json_decode($response->getBody(), true);
        return new DeliveryOrder($body);
    }

    public function edit($code, $param) {
        $endpoint = $this->endpointUrl .'/' .$code;

        $response = $this->client->getHttp()->request('PATCH', $endpoint, [
            'json' => $param
        ]);

        if ($response->getStatusCode() != 200) {
            throw new Exception($response->getBody()->getContents(), $response->getStatusCode());
        }

        $body = \GuzzleHttp\json_decode($response->getBody(), true);
        return isset($body)? new DeliveryOrder($body) : null;
    }

    public function comments($code) {
    }
}