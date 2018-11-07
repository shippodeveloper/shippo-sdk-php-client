<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 10/27/18
 * Time: 15:51
 */

namespace Shippo\Models;

use DateTime;

/**
 * Class Merchant
 * @package Shippo\Models
 *
 * @property-read integer $id
 * @property-read string $code
 * @property-read string $fullName
 * @property-read integer $gender
 * @property-read string $mobile
 * @property-read float $realBalance
 * @property-read string $avatar
 * @property-read string $email
 * @property-read boolean $isEmailVerified
 * @property-read string $state
 * @property-read array $bank
 * @property-read integer $version
 * @property-read DateTime $createdAt
 * @property-read DateTime $firstOrderAt
 * @property-read DateTime $lastOrderAt
 * @property-read DateTime $updateAt
 */
class Merchant extends BaseModel
{

    protected $date_fields = ['createdAt', 'firstOrderAt', 'lastOrderAt', 'updatedAt'];

    public function __construct($data)
    {
        $this->hydrate($data);
    }
}