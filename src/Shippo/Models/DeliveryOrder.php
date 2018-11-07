<?php
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 10/27/18
 * Time: 15:48
 */

namespace Shippo\Models;

use DateTime;

/**
 * Class DeliveryOrder
 * @package Shippo\Models
 *
 * @property-read integer $id
 * @property-read integer $merchantId
 * @property-read string $orderCode
 * @property-read string $merchantOrderCode
 * @property-read float $cod
 * @property-read float $realCod
 * @property-read float $totalFee
 * @property-read array $fees
 * @property-read array $services
 * @property-read float $totalMerchantFee
 * @property-read float $weight
 * @property-read string $state
 * @property-read array $goods
 * @property-read string $trackingLink
 * @property-read array $timeline
 * @property-read array $metadata
 * @property-read array $transitFailureNotes
 * @property-read integer $createFromOrder
 * @property-read string $pickupLocationIdsPath
 * @property-read string $pickupLocationNamesPath
 * @property-read string $pickupDetailAddress
 * @property-read string $pickupContact
 * @property-read string $pickupNote
 * @property-read string $deliverLocationIdsPath
 * @property-read string $deliverLocationNamesPath
 * @property-read string $receiverName
 * @property-read string $receiverPhone
 * @property-read string $deliveryNote
 * @property-read string $deliveryPackage
 * @property-read boolean $isReturn
 * @property-read integer $version
 * @property-read DateTime $createdAt
 * @property-read DateTime $updatedAt
 * @property-read DateTime $preparePickupAt
 * @property-read DateTime $pickedUpAt
 * @property-read DateTime $prepareDeliveryAt
 * @property-read DateTime $startDeliveryAt
 * @property-read DateTime $prepareRedeliveryAt
 * @property-read DateTime $failedDeliveryAt
 * @property-read DateTime $deliveryAt
 * @property-read DateTime $deliveryCompletedAt
 * @property-read DateTime $prepareReturnAt
 * @property-read DateTime $startReturnAt
 * @property-read DateTime $returnedAt
 * @property-read DateTime $returnedCompletedAt
 * @property-read DateTime $cancelledAt
 */
class DeliveryOrder extends BaseModel
{
    const STATE_CANCELLED = 'CANCELLED',
        STATE_WAITING_FOR_PICKUP = 'WAITING_FOR_PICKUP',
        STATE_PICKING_UP = 'PICKING_UP',
        STATE_PICKED_UP = 'PICKED_UP',
        STATE_DELIVERING = 'DELIVERING',
        STATE_DELIVERED = 'DELIVERED',
        STATE_COMPLETED = 'COMPLETED',
        STATE_REJECT = 'REJECT',
        STATE_LOST = 'LOST';

    protected $date_fields = ['createdAt', 'updatedAt', 'preparePickupAt', 'pickedUpAt', 'prepareDeliveryAt',
        'startDeliveryAt', 'prepareRedeliveryAt', 'failedDeliveryAt', 'deliveryAt', 'deliveryCompletedAt',
        'prepareReturnAt', 'startReturnAt', 'returnedAt', 'returnedCompletedAt', 'cancelledAt'];
    /**
     * DeliveryOrder constructor.
     * @param $data
     */
    public function __construct($data) {
        $this->hydrate($data);
    }
}