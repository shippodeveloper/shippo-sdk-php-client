<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 11/5/18
 * Time: 16:42
 */

namespace Shippo\Utils;


use DateTime;
use DateTimeInterface;
use DateTimeZone;

class DateTimeUtil
{
    /**
     * Convert DateTime object from string
     *
     * @param $source
     * @return DateTime
     */
    public static function convertDateTime($source): DateTime {
        $date = DateTime::createFromFormat('U', strtotime($source));
        $date->setTimezone(new DateTimeZone(date_default_timezone_get()));
        return $date;
    }
}