<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 10/27/18
 * Time: 15:51
 */

namespace Shippo\Models;


class Merchant extends BaseModel
{
    public function __construct($data)
    {
        $this->hydrate($data);
    }
}