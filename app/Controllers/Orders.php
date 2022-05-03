<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\ApiResourceFilter;
use App\Services\ClientAuthenticator;
use CodeIgniter\API\ResponseTrait;
use Config\Services;
use CodeIgniter\Files\File;
use Exception;
use GuzzleHttp\Client as HTTPClient;
use GuzzleHttp\Exception\BadResponseException;

class Orders extends BaseController
{
    use ResponseTrait;

    public HTTPClient $client;

    public function __construct()
    {
        $this->client = new HTTPClient();

        $apiEndpointsConfig = config('ApiEndpoints');
    }

    public function showOrders(string $name)
    {
        $data = [
            'email' => session()->email,
            'username' => session()->username,
            'name' => $name,
        ];

        // Get user details
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/user';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $userRes = json_decode($response->getBody(), true);
        // ENDS

        // Get orders start
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/all/orders';
        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }
        $ordersRes = json_decode($response->getBody(), true);
        // Get orders end

        return view('users/orders', [
            'title' => "Orders | " . $name,
            'orders' => $ordersRes['orders'],
            'user' => $userRes['user'],
            "name" => $name,
        ]);
    }
    public function viewOrder(string $name, string $order)
    {
        $data = [
            'email' => session()->email,
            'username' => session()->username,
            'name' => $name,
        ];

        // Get user details
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/user';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $userRes = json_decode($response->getBody(), true);

        // Get user details 
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/orderbyid';
        $data["orderId"] = $order;
        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $res  = json_decode($response->getBody(), true);

        return view('users/viewOrder', [
            'title' => "Order | " . $name,
            'user' => $userRes['user'],
            "name" => $name,
            "order" => $res["orders"][0],
        ]);
    }
    public function recentOrders(string $name)
    {
        $data = [
            'email' => session()->email,
            'username' => session()->username,
            'name' => $name,
            'shopName' => $name,
        ];

        $apiEndpoints = config('ApiEndpoints');

        // Get orders start
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/all/orders/recent';
        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }
        $ordersRes = json_decode($response->getBody(), true);
        // Get orders end

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/shop/name';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $shopRes = json_decode($response->getBody(), true);

        return view('shop/recent-orders', [
            'orders' => $ordersRes['orders'],
            "name" => $name,
            'shops' => $shopRes['shops'],
        ]);
    }

    public function orderProduct(string $shopName, string $product)
    {
        $data = [
            'email' => session()->email,
            'username' => session()->username,
            'shopName' => $shopName,
            'productId' => $product,
            'couponCode' => $this->request->getVar('couponCodeH'),
            'Quantity' => $this->request->getVar('Quantity'),
            'productName' => $this->request->getVar('productName'),
            'ProductPrice' => $this->request->getVar('productPrice'),
            'orderFrom' => $this->request->getVar('email'),
            'paymentGateway' => 'PayPal',
            'unitPrice' => $this->request->getVar('unitPrice'),
        ];
        // insert into orders
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/add/new/orders';

        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $orderRes = json_decode($response->getBody(), true);
        // ENDS
        if ($orderRes['status'] == "success") {
            $couponUses = $this->request->getVar('couponUses');
            $couponData = [
                'couponCode' => $this->request->getVar('couponCodeH'),
                'couponID' => $this->request->getVar('couponID'),
                'couponUses' => $couponUses,
            ];
            // insert into orders
            $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/update/coupon/order';

            try {
                $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $couponData]);
            } catch (BadResponseException $exception) {
                die($exception->getMessage());
            }

            $couponRes = json_decode($response->getBody(), true);
            session()->setFlashdata('success', '<i class="lni lni-check"></i> <strong>Success!</strong> Order recieved!');
        } else {
            session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> An error occurred ');
        }
        return redirect()->back();
    }
}