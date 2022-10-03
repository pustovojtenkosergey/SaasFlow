<?php

declare(strict_types=1);


namespace App\Infrastructure\Services\Saas\Api;

use App\Infrastructure\Domain\DTO\ParcelDTO;
use App\Infrastructure\Services\HttpService;
use App\Infrastructure\Services\Saas\Api\Auth\SaasApiAuthorizationService;
use App\Models\AddressField;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;

class SaasApiCreateParcelService
{
    private HttpService $http;

    public function __construct()
    {
        $this->http = new HttpService();

        $auth = new SaasApiAuthorizationService();
        $auth->execute();

        $this->http->addHeaders(['Authorization' => 'Bearer '.$auth->getToken()]);
    }

    public function execute(ParcelDTO $parcelDTO): array
    {
        try {
            $result = $this->http->post(config('saas.default.host').'/api/v2/parcels', $parcelDTO->toArray());
        } catch (Exception $exception) {
            if ($exception instanceof ClientException) {
                $errorResponse = json_decode($exception->getResponse()->getBody()->getContents(), true);
            }
            Log::error('SaasApiCreateParcelService', ['error' => $exception->getMessage()]);
        }

        return array_merge($result ?? [], $errorResponse ?? []);
    }

    public function createRandom(string $country)
    {
        $tracker = '';
        try {
            $result = $this->http->post(config('saas.default.host').'/api/v2/parcels', $this->getPostFields($country));

            if (empty($result['last_mile_carrier_tracking_number'])) {
                throw new Exception('Tracking number not found');
            }

            $tracker = $result['last_mile_carrier_tracking_number'];

        } catch (Exception $exception) {
            Log::error('SaasApiCreateParcelService', ['error' => $exception->getMessage()]);
        }

        return $tracker;
    }

    private function getService(int $index, bool $rand = false)
    {
        $services = [
            1 => 'SLG001',
            2 => 'SLG003',
            3 => 'SLG008',
        ];

        return $services[$rand ? rand(0,1) : $index];
    }

    private function getPostFields(string $country): array
    {
        $st_order_refence = uniqid('st_order_refence');
        return [
            'is_test' => false,
            'shipper_id' => 16,
            'service' => [
                "service_id" => $this->getService(1, false),
                "pudo_id" => "100",
                "label_format" => "PDF",
                "label_type" => "system",
                "label_template" => "",
                "display_id" => "",
                "shipping_cost" => [
                    "amount" => 10,
                    "currency" => "USD"
                ],
                "collection_date" => [
                    "date" => "2022-01-01 00:00:00",
                    "time_from" => "2022-01-01 00:00:00",
                    "time_to" => "2022-01-01 00:00:00"
                ],
                "delivery_date" => [
                    "date" => "2022-01-01 00:00:00",
                    "time_from" => "2022-01-01 00:00:00",
                    "time_to" => "2022-01-01 00:00:00"
                ]
            ],
            'package' => [
                "number_of_piece" => 1,
                "order_reference" => $st_order_refence,
                "customer_id_reference" => $st_order_refence,
                "rgr_number" => "ID123",
                "category" => "gifts",
                "dangerous_goods" => false,
                "incoterm" => "DDP",
                "invoice_number" => "IN123",
                "description" => "test description",
                "courier_instruction" => "Test parcel",
                "non_delivery_instruction" => "Test parcel",
                "pod_signature_required" => true,
                "value" => [
                    "amount" => 10,
                    "currency" => "SAR"
                ],
                "cod" => [
                    "amount" => 10,
                    "currency" => "SAR"
                ],
                "weight" => [
                    "weight_value" => 1,
                    "weight_unit" => "kg"
                ],
                "dimensions" => [
                    "length" => 2,
                    "width" => 2,
                    "height" => 2,
                    "dimensions_unit" => "cm"
                ],
                "extra_fields" => [
                    "extra_field_1" => "",
                    "extra_field_2" => "",
                    "extra_field_3" => ""
                ]
            ],
            'shipper_address' => $this->getAddress('AE'),
            'consignee_address' => $this->getAddress($country),
            'parcel_items' => [
                [
                    "quantity" => 1,
                    "description" => "Test parcelTest parcelTest parcelTest parcelTest parcel",
                    "value" => [
                        "amount" => 10,
                        "currency" => "SAR"
                    ],
                    "country_of_origin" => "GB",
                    "sku" => "",
                    "hs_code" => "103000",
                    "image_url" => "https://test.com/image.png",
                    "product_url" => "https://test.com/product",
                    "extra_fields" => [
                        "extra_field_1" => "",
                        "extra_field_2" => "",
                        "extra_field_3" => ""
                    ]
                ],[
                    "quantity" => 2,
                    "description" => "Test parcelTest parcelTest parcelTest parcelTest parcel",
                    "value" => [
                        "amount" => 15,
                        "currency" => "SAR"
                    ],
                    "country_of_origin" => "GB",
                    "sku" => "ID123123",
                    "hs_code" => "103000",
                    "image_url" => "https://test.com/image.png",
                    "product_url" => "https://test.com/product",
                    "extra_fields" => [
                        "extra_field_1" => "",
                        "extra_field_2" => "",
                        "extra_field_3" => ""
                    ]
                ],
//                [
//                    "quantity" => 1,
//                    "description" => "documents",
//                    "value" => [
//                        "amount" => 5,
//                        "currency" => "USD"
//                    ],
//                    "country_of_origin" => "GB",
//                    "sku" => "ID123123",
//                    "hs_code" => "123456",
//                    "image_url" => "https://test.com/image.png",
//                    "product_url" => "https://test.com/product",
//                    "extra_fields" => [
//                        "extra_field_1" => "",
//                        "extra_field_2" => "",
//                        "extra_field_3" => ""
//                    ]
//                ],
//                [
//                    "quantity" => 1,
//                    "description" => "Test parcel",
//                    "value" => [
//                        "amount" => 15,
//                        "currency" => "USD"
//                    ],
//                    "country_of_origin" => "GB",
//                    "sku" => "ID123144",
//                    "hs_code" => "123456",
//                    "image_url" => "https://test.com/image.png",
//                    "product_url" => "https://test.com/product",
//                    "extra_fields" => [
//                        "extra_field_1" => "",
//                        "extra_field_2" => "",
//                        "extra_field_3" => ""
//                    ]
//                ]
            ],
        ];
    }

    private function getAddress($country): array
    {
        $address = AddressField::where('country', $country)->inRandomOrder()->get()->first();
        $arr = $address->toArray();

//        $arr['name'] = 'Usama Ben Laden';


//        $arr['state'] = '';
//        $arr['city'] = 'Dubai';

        unset($arr['id']);
        $arr['extra_fields'] = json_decode($arr['extra_fields'], true);
        return $arr;
    }
}
