[![Build Status](https://travis-ci.org/shippodeveloper/shippo-sdk-php-client.svg?branch=master)](https://travis-ci.org/shippodeveloper/shippo-sdk-php-client)
[![Latest Stable Version](https://poser.pugx.org/shippodeveloper/shippo-sdk-php-client/v/stable)](https://packagist.org/packages/shippodeveloper/shippo-sdk-php-client)
[![Total Downloads](https://poser.pugx.org/shippodeveloper/shippo-sdk-php-client/downloads)](https://packagist.org/packages/shippodeveloper/shippo-sdk-php-client)
[![Latest Unstable Version](https://poser.pugx.org/shippodeveloper/shippo-sdk-php-client/v/unstable)](https://packagist.org/packages/shippodeveloper/shippo-sdk-php-client)
[![License](https://poser.pugx.org/shippodeveloper/shippo-sdk-php-client/license)](https://packagist.org/packages/shippodeveloper/shippo-sdk-php-client)

# SHIPPO APIs Client Library for PHP #
The Shippo API Client Library for PHP enables you working with Shippo's Open API. These library are officially supported by Shippo. 

**Open API**

Is Shippo's public API that provides developers or partner with programmatic access to Shippo's system. 
More detail [here](https://open-api.shippo.vn/#k%E1%BA%BFt-n%E1%BB%91i-v%E1%BB%9Bi-shippo-s%E1%BA%BD-mang-%C4%91%E1%BA%BFn-nh%E1%BB%AFng-kh%E1%BA%A3-n%C4%83ng-g%C3%AC).  
 
## APIs documentation ##
https://open-api.shippo.vn/

## Installation ##
### Requirements ###
* PHP 7+

### Composer ###
To install run `composer require shippodeveloper/shippo-sdk-php-client`


##Usage

### Configuration ##
Configuration is done through an instance of ShippoSDK\Client with ShippoSDK\Config. 

```php
$config = new \ShippoSDK\Config([
    'access_token' => 'your access token',
    'base_uri' => 'https://apix.shippo.vn', // or https://sandbox-apix.shippo.vn for sandbox mode
]);
$client = new \ShippoSDK\Client($config);
```

### API Endpoints
Each APIs was implement as API Endpoint class.

This example working with Delivery Order

```php
$deliveryOrderEP = new \ShippoSDK\Endpoints\DeliveryOrderEndpoint($client);
$param = [
    'pickupAddressId' => 100022031,
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
    'code' => '380000',
    'deliveryNote' => '',
    'receiverPhone' => '0380987654',
    'receiverName' => 'Brian May',
    'deliverDetailAddress' => 'Fist Aid 1985',
    'deliverLocationId' => 18, //Ba Đình
    'pickupNote' => 'Đến gọi cho Mary Austin'
];
$order = $deliveryOrderEP->create($param);
```

Please see the test scripts in the `tests` directory to understand how it works

## To be contributor ##
We embrace developers to contribute to Shippo's developer libraries. In addition to PHP, developers can develop integrated libraries with Shippo's Open API for NodeJS, Java, Ruby, and Python.

Shippo grateful for your help!

## Copyright and license
Copyright 2018-present Shippo

Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. You may botain a copy of the License at
 
http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.


