<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 10/27/18
 * Time: 17:26
 */

namespace Shippo\Models;


use DateTime;
use DateTimeInterface;
use GuzzleHttp\Psr7\Response;
use Shippo\Utils\DateTimeUtil;

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

        for ($ii = 0, $size = count($this->date_fields); $ii < $size; ++$ii) {
            if (!isset($data[$this->date_fields[$ii]]) || $data[$this->date_fields[$ii]] == null) {
                continue;
            }
            $this->data[$this->date_fields[$ii]] = DateTimeUtil::convertDateTime($data[$this->date_fields[$ii]]);
        }
    }

    public function __get($name) {
        return isset($this->data[$name])? $this->data[$name] : null;
    }
}