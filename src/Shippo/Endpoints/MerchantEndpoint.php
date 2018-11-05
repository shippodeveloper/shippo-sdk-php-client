<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 11/5/18
 * Time: 10:56
 */

namespace Shippo\Endpoints;


use Shippo\Client;
use Shippo\Collection;
use Shippo\Exception;
use Shippo\Models\Merchant;

class MerchantEndpoint extends BaseEndpoint
{
    protected $endpoint = '/my/pickup_address';
    /**
     * MerchantEndpoint constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
    }

    public function get(): Collection {
        $endpoint = '/my/pickup_addresses';
    }

    /**
     * Create new merchant's pickup address
     *
     * @param $param
     * @return Merchant
     * @throws \GuzzleHttp\Exception\GuzzleException | Exception
     */
    public function create($param): Merchant {
        $response = $this->client->getHttp()->request('POST', $this->endpoint, [
            'json' => $param
        ]);

        if ($response->getStatusCode() != 200) {
            throw new Exception($response->getBody()->getContents(), $response->getStatusCode());
        }

        $body = \GuzzleHttp\json_decode($response->getBody(), true);
        return new Merchant($body);
    }

    /**
     * @param int $id
     * @return Merchant
     * @throws \GuzzleHttp\Exception\GuzzleException | Exception
     */
    public function detail(int $id): Merchant {
        $endpoint = $this->endpoint .'/' .$id;

        $response = $this->client->getHttp()->request('GET', $endpoint);
        if ($response->getStatusCode() != 200) {
            throw new Exception($response->getBody()->getContents(), $response->getStatusCode());
        }

        $body = \GuzzleHttp\json_decode($response->getBody(), true);
        return isset($body['result'])? new Merchant($body['result']) : null;
    }

    /**
     * @param int $id
     * @param $param
     * @return Merchant
     * @throws \GuzzleHttp\Exception\GuzzleException | Exception
     */
    public function edit(int $id, $param): Merchant {
        $endpoint = $this->endpoint .'/' .$id;

        $response = $this->client->getHttp()->request('PATH', $endpoint, [
            'json' => $param
        ]);

        if ($response->getStatusCode() != 200) {
            throw new Exception($response->getBody()->getContents(), $response->getStatusCode());
        }

        $body = \GuzzleHttp\json_decode($response->getBody(), true);
        return isset($body['result'])? new Merchant($body['result']) : null;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException | Exception
     */
    public function delete(int $id): bool {
        $endpoint = $this->endpoint .'/' .$id;

        $response = $this->client->getHttp()->request('DELETE', $endpoint);

        if ($response->getStatusCode() != 200) {
            throw new Exception($response->getBody()->getContents(), $response->getStatusCode());
        }

        return $response->getStatusCode() == 200;
    }
}