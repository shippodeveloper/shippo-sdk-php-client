<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 10/27/18
 * Time: 15:48
 */

namespace Shippo\Models;


class DeliveryOrder extends BaseModel
{
    /**
     * DeliveryOrder constructor.
     * @param $data
     */
    public function __construct($data) {
        $this->hydrate($data);
    }
}