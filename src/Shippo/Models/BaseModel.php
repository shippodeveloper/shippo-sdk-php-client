<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 10/27/18
 * Time: 17:26
 */

namespace Shippo\Models;


use GuzzleHttp\Psr7\Response;

abstract class BaseModel
{
    protected $data;
    protected $date_fields = [];

    /**
     * Hydrate model from array
     * @param $data
     */
    protected function hydrate($data) {
        $this->data = $data;
    }

    public function __get($name) {
        return isset($this->data[$name])? $this->data[$name] : null;
    }
}