<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 11/5/18
 * Time: 16:37
 */


class DateUtilTest extends \PHPUnit\Framework\TestCase
{
    public function testConvertDateTime() {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $input = '2016-11-10T08:17:23.000Z';
        $date = \ShippoSDK\Utils\DateTimeUtil::convertDateTime($input);
        $this->assertEquals('10/11/2016 15:17:23', $date->format('d/m/Y H:i:s'), 'Date after convert not match');
    }
}
