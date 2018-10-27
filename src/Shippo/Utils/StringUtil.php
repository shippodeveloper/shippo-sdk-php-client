<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 10/27/18
 * Time: 16:56
 */

namespace Shippo\Utils;


class StringUtil
{
    /**
     * convert word from camel case to underscore
     * e.g: "LuuTrongHieu" -> "luu_trong_hieu"
     * @param $word
     * @return string
     */
    public static function camelCaseToUnderscore($word):string {
        return strtolower(preg_replace('~(?<=\\w)([A-Z])~', '_$1', $word));
    }
}