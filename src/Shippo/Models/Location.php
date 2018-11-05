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
 * @property-read integer $id
 * @property-read string $name
 * @property-read string $postalCode
 * @property-read integer $level
 * @property-read integer $parentId
 * @property-read string $state
 * @property-read string $lineage
 * @property-read string $code
 * @property-read integer $priority
 * @property-read DateTime $createdAt
 * @property-read DateTime $updatedAt
 */
class Location extends BaseModel
{
    /**
     * Location constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->hydrate($data);
    }
}