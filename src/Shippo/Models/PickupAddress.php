<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 10/27/18
 * Time: 15:49
 */

namespace Shippo\Models;

use DateTime;

/**
 * Class PickupAddress
 * @package Shippo\Models
 *
 * @property-read integer $id
 * @property-read integer $merchantId
 * @property-read string $contactName
 * @property-read string $contactPhone
 * @property-read string $detailAddress
 * @property-read string $fullAddress
 * @property-read string $locationIdsPath
 * @property-read integer $version
 * @property-read DateTime $createdAt
 * @property-read DateTime $updatedAt
 */
class PickupAddress extends BaseModel
{
    protected $date_fields = ['createdAt', 'updatedAt'];

    public function __construct($data)
    {
        $this->hydrate($data);
    }
}