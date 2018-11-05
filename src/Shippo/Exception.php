<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 11/5/18
 * Time: 11:51
 */

namespace Shippo;


use Throwable;

class Exception extends \RuntimeException
{
    protected $name;

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        $exceptionData = json_decode($message, true);
        if (null !== $exceptionData) {
            $message = $exceptionData['message'];
            $this->name = $exceptionData['name'];
        }
        parent::__construct($message, $code, $previous);
    }

    /**
     * Gets the Exception name
     * @return string the Exception name as a string.
     * @since 5.1.0
     */
    final public function getName() {
        return $this->name;
    }
}