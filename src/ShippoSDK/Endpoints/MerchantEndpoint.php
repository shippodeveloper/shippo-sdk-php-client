<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 11/5/18
 * Time: 10:56
 */

namespace ShippoSDK\Endpoints;


use ShippoSDK\Client;
use ShippoSDK\Collection;
use ShippoSDK\Exception;
use ShippoSDK\Models\Merchant;

class MerchantEndpoint extends BaseEndpoint
{
    private $endpointUrl = '/my/profiles';

    /**
     * MerchantEndpoint constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
    }

    /**
     * Get merchant profiles
     *
     * @return null|Merchant
     * @throws \GuzzleHttp\Exception\GuzzleException | Exception
     */
    public function profiles() {
        $response = $this->client->getHttp()->request('GET', $this->endpointUrl);
        if ($response->getStatusCode() != 200) {
            throw new Exception($response->getBody()->getContents(), $response->getStatusCode());
        }

        $body = \GuzzleHttp\json_decode($response->getBody(), true);
        return isset($body['result'])? new Merchant($body['result']) : null;
    }
}