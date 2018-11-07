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
use Shippo\Models\PickupAddress;

class PickupAddressEndpoint extends BaseEndpoint
{
    protected $endpointUrl = '/my/pickup_address';

    /**
     * MerchantEndpoint constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
    }

    /**
     * Get list of pickup addresses
     *
     * @return Collection
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(): Collection {
        $endpoint = '/my/pickup_addresses';

        $response = $this->client->getHttp()->request('GET', $endpoint);
        if ($response->getStatusCode() != 200) {
            throw new Exception($response->getBody()->getContents(), $response->getStatusCode());
        }


        $body = \GuzzleHttp\json_decode($response->getBody(), true);
        $collect = new Collection();
        if (isset($body['result'])) {
            for ($ii = 0, $size = count($body['result']); $ii < $size; ++$ii) {
                $collect->push(new PickupAddress($body['result'][$ii]));
            }
        }

        return $collect;
    }

    /**
     * Create new merchant's pickup address
     *
     * @param $param
     * @return PickupAddress
     * @throws \GuzzleHttp\Exception\GuzzleException | Exception
     */
    public function create($param) {
        $response = $this->client->getHttp()->request('POST', $this->endpointUrl, [
            'json' => $param
        ]);

        if (!$this->is2xxHttpStatus($response->getStatusCode())) {
            throw new Exception($response->getBody()->getContents(), $response->getStatusCode());
        }

        $body = \GuzzleHttp\json_decode($response->getBody(), true);
        return new PickupAddress($body);
    }

    /**
     * @param int $id
     * @return PickupAddress | null
     * @throws \GuzzleHttp\Exception\GuzzleException | Exception
     */
    public function detail(int $id) {
        $endpoint = $this->endpointUrl .'/' .$id;

        $response = $this->client->getHttp()->request('GET', $endpoint);
        if ($response->getStatusCode() != 200) {
            throw new Exception($response->getBody()->getContents(), $response->getStatusCode());
        }

        $body = \GuzzleHttp\json_decode($response->getBody(), true);
        return isset($body['result'])? new PickupAddress($body['result']) : null;
    }

    /**
     * @param int $id
     * @param $param
     * @return PickupAddress | null
     *
     * @throws \GuzzleHttp\Exception\GuzzleException | Exception
     */
    public function edit(int $id, $param) {
        $endpoint = $this->endpointUrl .'/' .$id;

        $response = $this->client->getHttp()->request('PATCH', $endpoint, [
            'json' => $param
        ]);

        if ($response->getStatusCode() != 200) {
            throw new Exception($response->getBody()->getContents(), $response->getStatusCode());
        }

        $body = \GuzzleHttp\json_decode($response->getBody(), true);
        return isset($body['result'])? new PickupAddress($body['result']) : null;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException | Exception
     */
    public function delete(int $id): bool {
        $endpoint = $this->endpointUrl .'/' .$id;

        $response = $this->client->getHttp()->request('DELETE', $endpoint);

        if ($response->getStatusCode() != 200) {
            throw new Exception($response->getBody()->getContents(), $response->getStatusCode());
        }

        return $response->getStatusCode() == 200;
    }
}