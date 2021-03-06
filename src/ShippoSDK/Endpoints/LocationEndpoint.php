<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 10/27/18
 * Time: 16:43
 */

namespace ShippoSDK\Endpoints;


use ShippoSDK\Client;
use ShippoSDK\Collection;
use ShippoSDK\Exception;
use ShippoSDK\Models\Location;

class LocationEndpoint extends BaseEndpoint
{

    /**
     * LocationEndpoint constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
    }

    /**
     * Get Shippo's locations
     * @link https://open-api.shippo.vn/api-endpoints/dia-diem#lay-danh-sach-tat-ca-dia-danh
     * @param string|null $parent_path
     * @return Collection
     * @throws \GuzzleHttp\Exception\GuzzleException | Exception
     */
    public function get(string $parent_path = null) {
        $endpoint = '/config/locations';
        $options = [];
        if (null != $parent_path) {
            $options['query']['parent_path'] = $parent_path;
        }

        $response = $this->client->getHttp()->request('GET', $endpoint, $options);
        if ($response->getStatusCode() != 200) {
            throw new Exception($response->getBody()->getContents(), $response->getStatusCode());
        }


        $body = \GuzzleHttp\json_decode($response->getBody(), true);
        $collect = new Collection();
        if (isset($body['result'])) {
            for ($ii = 0, $size = count($body['result']); $ii < $size; ++$ii) {
                $collect->push(new Location($body['result'][$ii]));
            }
        }

        return $collect;
    }

    /**
     * Get location detail by id
     * @link https://open-api.shippo.vn/api-endpoints/dia-diem#chi-tiet-dia-danh
     * @param int $id
     * @return Location | null
     * @throws \GuzzleHttp\Exception\GuzzleException | Exception
     */
    public function detail(int $id) {
        $endpoint = '/config/location/' .$id;
        $response = $this->client->getHttp()->request('GET', $endpoint);
        if ($response->getStatusCode() != 200) {
            throw new Exception($response->getBody()->getContents(), $response->getStatusCode());
        }

        $body = \GuzzleHttp\json_decode($response->getBody(), true);
        return isset($body['result'])? new Location($body['result']) : null;
    }
}