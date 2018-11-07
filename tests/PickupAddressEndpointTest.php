<?php

/**
 * Created by PhpStorm.
 * User: luuthieu
 * Date: 11/7/18
 * Time: 15:58
 */

class PickupAddressEndpointTest extends BaseTest
{
    /**
     * @var \Shippo\Endpoints\PickupAddressEndpoint
     */
    private $endpoint;

    private $clearList = [];

    /**
     * @before
     */
    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->endpoint = new \Shippo\Endpoints\PickupAddressEndpoint($this->getClient());
    }

    public function testGet() {
        //create 3 addresses
        $param1 = [
            'contactName' => 'Chế Lan Viên',
            'contactPhone' => '0987654321',
            'locationId' => 37,
            'detailAddress' => 'Số 1 ngõ 2/12 đường Tiếng Hát Con Tầu',
        ];

        $param2 = [
            'contactName' => 'Nguyên Ngọc',
            'contactPhone' => '0987654321',
            'locationId' => 37,
            'detailAddress' => 'Số 1 ngõ 2/12 Phố Đất Nước Đứng Lên',
        ];

        $param3 = [
            'contactName' => 'Nguyễn Đình Thi',
            'contactPhone' => '0987654321',
            'locationId' => 37,
            'detailAddress' => 'Số 1 ngõ 2/12 Phố Ông Đồ',
        ];

        $this->_createPA($param1);
        $this->_createPA($param2);
        $this->_createPA($param3);

        $list = $this->endpoint->get();
        $this->assertGreaterThan(0, $list->count(), 'List not empty');
    }

    public function testCreate() {
        $param = [
            'contactName' => 'Lưu Quang Vũ',
            'contactPhone' => '0981234567',
            'locationId' => 37,
            'detailAddress' => 'Số 1 ngõ 2/12 Phạm Hồng Thái',
        ];

        $pa = $this->endpoint->create($param);
        $this->assertEquals($param['contactName'], $pa->contactName);
        $this->assertEquals('9.37', $pa->locationIdsPath);
        $this->clearList[] = $pa->id;
    }

    public function testDetail() {
        $param = [
            'contactName' => 'Xuân Quỳnh',
            'contactPhone' => '0987654321',
            'locationId' => 37,
            'detailAddress' => 'Số 1 ngõ 2/12 Phố Ta',
        ];

        $samplePA = $this->_createPA($param);

        $pa = $this->endpoint->detail($samplePA->id);

        $this->assertEquals($samplePA->id, $pa->id);
        $this->assertEquals($samplePA->contactPhone, $pa->contactPhone);
    }

    public function testEdit() {
        $param = [
            'contactName' => 'Xuân Quỳnh',
            'contactPhone' => '0987654321',
            'locationId' => 37,
            'detailAddress' => 'Số 1 ngõ 2/12 Phố Ta',
        ];

        $samplePA = $this->_createPA($param);

        $update = [
            'contactPhone' => '0381234567',
            'detailAddress' => 'Số 1 ngõ 3/12 Thuyền và Biển',
        ];

        $this->endpoint->edit($samplePA->id, $update);
        $pa = $this->endpoint->detail($samplePA->id);

        $this->assertEquals($update['contactPhone'], $pa->contactPhone);
        $this->assertEquals($update['detailAddress'], $pa->detailAddress);
    }

    /**
     * @expectedException \Shippo\Exception
     * @expectedExceptionCode 404
     */
    public function testDelete() {
        $pa = $this->_createPA([
            'contactName' => 'Xuân Quỳnh',
            'contactPhone' => '0987654321',
            'locationId' => 37,
            'detailAddress' => 'Số 1 ngõ 2/12 Phố Ta',
        ]);

        $result = $this->endpoint->delete($pa->id);
        $this->assertEquals(true, $result);
        $this->endpoint->detail($pa->id);
    }

    private function _createPA($param = []) {
        $param = [
            'contactName' => 'Xuân Quỳnh',
            'contactPhone' => '0987654321',
            'locationId' => 37,
            'detailAddress' => 'Số 1 ngõ 2/12 Phố Ta',
        ];

        $pa = $this->endpoint->create($param);
        $this->clearList[] = $pa->id;

        return $pa;
    }

    /**
     * @after
     */
    protected function tearDown()
    {
        for ($ii = 0, $size = count($this->clearList); $ii < $size; ++$ii) {
            $this->endpoint->delete($this->clearList[$ii]);
        }

        parent::tearDown(); // TODO: Change the autogenerated stub
    }
}