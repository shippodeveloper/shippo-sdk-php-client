<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 10/27/18
 * Time: 16:52
 */

namespace Shippo;


use Shippo\Utils\StringUtil;

/**
 * Class Config
 * @package Shippo
 *
 * @method string getAccessToken()
 * @method string getBaseUri()
 * @method integer getTimeout() //timeout in seconds
 */
class Config
{
    protected $config;

    /**
     * Config constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }


    public function __call($method, $arguments)
    {
        if(strpos($method, 'get') === 0) {
            $name = StringUtil::camelCaseToUnderscore(substr($method, 3, strlen($method)));
            return isset($this->config[$name])? $this->config[$name] : null;
        }
    }
}