<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 10/27/18
 * Time: 15:49
 */

namespace Shippo\Models;


class PickupAddress extends BaseModel
{
    public function __construct($data)
    {
        $this->hydrate($data);
    }
}