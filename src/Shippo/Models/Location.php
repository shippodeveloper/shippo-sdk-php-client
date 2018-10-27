<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 10/27/18
 * Time: 15:49
 */

namespace Shippo\Models;


class Location extends BaseModel
{
    public $id;
    public $name;
    public $postalCode;
    public $level;
    public $parentId;
    public $state;
    public $lineage;
    public $code;
    public $priority;
    public $createdAt;
    public $updatedAt;

    /**
     * Location constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->hydrate($data);
    }
}