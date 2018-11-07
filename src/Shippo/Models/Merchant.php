<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 10/27/18
 * Time: 15:51
 */

namespace Shippo\Models;

use DateTime;

class Merchant extends BaseModel
{

    protected $date_fields = ['createdAt', 'updatedAt'];

    public function __construct($data)
    {
        $this->hydrate($data);
    }
}