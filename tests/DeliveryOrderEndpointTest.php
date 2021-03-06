<?php
require_once __DIR__ .'/BaseTest.php';
/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 11/7/18
 * Time: 18:26
 */

class DeliveryOrderEndpointTest extends BaseTest
{
    /**
     * @var \ShippoSDK\Endpoints\DeliveryOrderEndpoint
     */
    private $endpoint;

    private $clearPickupAddressIds = [];
    /**
     * @before
     */
    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->endpoint = new \ShippoSDK\Endpoints\DeliveryOrderEndpoint($this->getClient());
    }

    public function testCreate() {
        //create pickup address first
        $pa = $this->_createPickupAddress();

        $param = [
            'pickupAddressId' => $pa->id,
            'services' => [
                'insurance' => [
                    'amount' => 1000000, //bảo hiểm với số tiền 1 triệu đồng
                ]
            ],
            'goods' => [],
            'chargeType' => 'SENDER',
            'deliveryPackage' => 'STC',
            'merchantOrderCode' => 'MOC_0001',
            'merchantPrivateNote' => 'Freddie Mercury is gay',
            'cod' => '380000',
            'deliveryNote' => '',
            'receiverPhone' => '0380987654',
            'receiverName' => 'Brian May',
            'deliverDetailAddress' => 'Fist Aid 1985',
            'deliverLocationId' => 18, //Ba Đình
            'pickupNote' => 'Đến gọi cho Mary Austin'
        ];
        $order = $this->endpoint->create($param);
        $this->assertStringEndsWith($pa->locationIdsPath, $order->pickupLocationIdsPath);
        $this->assertEquals($param['receiverName'], $order->receiverName);
        $this->assertEquals($param['receiverPhone'], $order->receiverPhone);
        $this->assertStringEndsWith((string) $param['deliverLocationId'], $order->deliverLocationIdsPath);
    }

    public function testDetail() {
        $sampleOrder = $this->_createDeliveryOrder();
        $order = $this->endpoint->detail($sampleOrder->orderCode);

        $this->assertEquals($sampleOrder->id, $order->id);
        $this->assertEquals($sampleOrder->receiverPhone, $order->receiverPhone);
    }

    public function testCancel() {
        $sampleOrder = $this->_createDeliveryOrder();

        $order = $this->endpoint->changeState($sampleOrder->orderCode, \ShippoSDK\Models\DeliveryOrder::STATE_CANCELLED);

        $this->assertEquals($sampleOrder->id, $order->id);
        $this->assertEquals($sampleOrder->receiverName, $order->receiverName);
        $this->assertEquals(\ShippoSDK\Models\DeliveryOrder::STATE_CANCELLED, $order->state);
    }

    public function testChangeCOD() {
        $newCod = \random_int(100000, 2000000);
        $sampleOrder = $this->_createDeliveryOrder();

        $order = $this->endpoint->edit($sampleOrder->orderCode, [
            'cod' => $newCod
        ]);

        $this->assertEquals($sampleOrder->id, $order->id);
        $this->assertEquals($sampleOrder->receiverName, $order->receiverName);
        $this->assertEquals($newCod, $order->cod);
    }

    public function testChangeReceiver() {
        $sampleOrder = $this->_createDeliveryOrder();
        $param = [
            'receiverName' => 'Huỳnh Văn Nghệ',
            'deliverDetailAddress' => 'Số 2 Ngụy Như Kontum',
            'deliverLocationId' => 711
        ];

        $order = $this->endpoint->edit($sampleOrder->orderCode, $param);

        $this->assertEquals($sampleOrder->id, $order->id);
        $this->assertEquals($param['receiverName'], $order->receiverName);
        $this->assertEquals($param['deliverDetailAddress'], $order->deliverDetailAddress);
        $this->assertStringEndsWith((string) $param['deliverLocationId'], $order->deliverLocationIdsPath);
    }

    private function _createPickupAddress(): \ShippoSDK\Models\PickupAddress {
        $pickupAddressEP = new \ShippoSDK\Endpoints\PickupAddressEndpoint($this->getClient());
        $list = $pickupAddressEP->get();
        if ($list->count() > 0) {
            return $list[0];
        }

        $param = [
            'contactName' => 'Xuân Quỳnh',
            'contactPhone' => '0987654321',
            'locationId' => 11,
            'detailAddress' => 'Số 1 ngõ 2/12 Phố Ta',
        ];
        $pa = $pickupAddressEP->create($param);
        $this->clearPickupAddressIds[] = $pa->id;

        return $pa;
    }

    private function _createDeliveryOrder(): \ShippoSDK\Models\DeliveryOrder {
        //create pickup address first
        $pa = $this->_createPickupAddress();

        $param = [
            'pickupAddressId' => $pa->id,
            'chargeType' => 'SENDER',
            'deliveryPackage' => 'STC',
            'merchantOrderCode' => 'MOC_0001',
            'merchantPrivateNote' => 'Freddie Mercury is gay',
            'cod' => '0',
            'deliveryNote' => '',
            'receiverPhone' => '0380987654',
            'receiverName' => 'Brian May',
            'deliverDetailAddress' => 'Fist Aid 1985',
            'deliverLocationId' => 18, //Ba Đình
            'pickupNote' => 'Đến gọi cho Mary Austin'
        ];
        return $this->endpoint->create($param);
    }

    /**
     * @after
     */
    protected function tearDown()
    {
        $pickupAddressEP = new \ShippoSDK\Endpoints\PickupAddressEndpoint($this->getClient());
        foreach ($this->clearPickupAddressIds as $id) {
            $pickupAddressEP->delete($id);
        }

        $this->clearPickupAddressIds = [];

        parent::tearDown(); // TODO: Change the autogenerated stub
    }
}