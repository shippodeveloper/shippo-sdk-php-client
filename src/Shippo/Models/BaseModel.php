<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 10/27/18
 * Time: 17:26
 */

namespace Shippo\Models;


abstract class BaseModel
{
    protected $date_fields = [];

    protected function hydrate($data) {
    }
}