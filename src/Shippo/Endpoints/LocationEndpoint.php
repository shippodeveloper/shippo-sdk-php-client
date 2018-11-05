<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 10/27/18
 * Time: 16:43
 */

namespace Shippo\Endpoints;


use GuzzleHttp\Psr7\Response;
use Shippo\Client;
use Shippo\Collection;
use Shippo\Models\Location;

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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLocations(string $parent_path = null): Collection {
        $endpoint = '/config/locations';
        $options = [];
        if (null != $parent_path) {
            $options['query']['parent_path'] = $parent_path;
        }

        $response = $this->client->getHttp()->request('GET', $endpoint, $options);
        $body = \GuzzleHttp\json_decode($response->getBody(), true);
        $collect = new Collection();
        if (isset($body['result']) && @$body['httpCode'] == 200) {
            for ($ii = 0, $size = count($body['result']); $ii < $size; ++$ii) {
                $collect->push(new Location($body['result'][$ii]));
            }
        }

        return $collect;
    }

    public function getLocationDetail(int $id): Location {
        $endpoint = '/config/location/' .$id;
        $response = $this->client->getHttp()->request('GET', $endpoint);

        $body = \GuzzleHttp\json_decode($response->getBody(), true);
    }
}