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

class Shop extends BaseController
{
    use ResponseTrait;

    public HTTPClient $client;

    public function __construct()
    {
        $this->client = new HTTPClient();

        $apiEndpointsConfig = config('ApiEndpoints');
    }

    public function showShopPage()
    {
        $page = $this->request->getVar('page') ?? 1;
        $limit = $this->request->getVar('limit') ?? 10;
        $data = [
            'email' => session()->email,
            'username' => session()->username,
            'page' => $page,
            'limit' => $limit,
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

        // Get user's shops

        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/shop';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $shopRes = json_decode($response->getBody(), true);

        return view('users/shop', [
            'title' => 'Shops',
            'user' => $userRes['user'],
            'shops' => $shopRes['shops'],
            "url" => $apiEndpoints->baseUrl,
        ]);
    }

    public function showDashboard(string $name)
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

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/notifications/all';

        try {
            $responsenot = $this->client->request('GET', $oauthxTokenEndpoint);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $noteall = json_decode($responsenot->getBody(), true);

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/notifications/shopName';

        try {
            $responses = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => ["shopname" => $name]]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $notsingle = json_decode($responses->getBody(), true);

        // Get user details end

        return view('users/dashboard', [
            'title' => "Dashboard | " . $name,
            'user' => $userRes['user'],
            "name" => $name,
            "noteall" => $noteall["notifications"],
            "notsingle" => $notsingle["notifications"]
        ]);
    }

    public function showProducts(string $name)
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

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/top/products';

        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $ordersRes = json_decode($response->getBody(), true);

        return view('users/products', [
            'title' => "Products | " . $name,
            'products' => $ordersRes['products'],
            'user' => $userRes['user'],
            "name" => $name,
        ]);
    }

    public function createShop()
    {
        $data = [
            'email' => session()->email,
            'username' => session()->username,
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

        // Get user's shops

        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/shop';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $shopRes = json_decode($response->getBody(), true);
        return view('users/create', [
            'title' => 'Shops',
            'user' => $userRes['user'],
            "shops" => $shopRes["shops"]
        ]);
    }

    public function createShopNow()
    {
        $data = [
            'username' => session()->username,
            'name' => $this->request->getVar('Name'),
        ];

        if ($data["name"] !== "") {
            $apiEndpoints = config('ApiEndpoints');
            $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/add/new/shop';

            try {
                $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
            } catch (BadResponseException $exception) {
                die($exception->getMessage());
            }

            $shopRes = json_decode($response->getBody(), true);

            $status = $shopRes['status'];

            session()->setFlashdata($shopRes['status'], $shopRes['message']);
            return redirect()->route('shop');
        } else {
            session()->setFlashdata("error", "Empty Data");
            return redirect()->route('createshopnow');
        }
        // Add user's shops


    }

    public function deleteShop(string $id, string $shopName)
    {
        $data = [
            'username' => session()->username,
            'id' => $id,
            'shopName' => $shopName
        ];

        // Get user details
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/delete/shop';

        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }
        $shopRes = json_decode($response->getBody(), true);

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/delete/shop/blacklist';
        $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/delete/shop/categories';
        $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/delete/shop/coupons';
        $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/delete/shop/feedbacks';
        $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/delete/shop/licenses';
        $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/delete/shop/orders';
        $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/delete/shop/procat';
        $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/delete/shop/products';
        $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/delete/shop/projects';
        $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/delete/shop/tickets';
        $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);



        session()->setFlashdata($shopRes['status'], $shopRes['message']);
        return redirect()->route('shop');
    }

    public function analytics(string $id)
    {
        return "Analytics";
    }

    public function boxDisputes(string $name)
    {
        $data = [
            'username' => session()->username,
            'name' => $name,
            'shopName' => $name,
        ];

        // Get user detailss
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/top/products';

        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $shopRes = json_decode($response->getBody(), true);

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/vendors/daily/revenue/dashboard';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $revenue = json_decode($response->getBody(), true);

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/vendor/daily/orders/dashboard';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $dailyorder = json_decode($response->getBody(), true);
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/vendor/overall/sales/dashboard';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $overallSales = json_decode($response->getBody(), true);

        $status = $shopRes['status'];
        return view('shop/box-disputes', [
            'user' => $shopRes['products'],
            'DailyRevenue' => $revenue['DailyRevenue']['DailyRevenue'],
            'DailyOrderCount' => $dailyorder['DailyOrderCount']['orderCount'],
            'overallSales' => $overallSales['overallSales']['overallSales']
        ]);
    }

    public function Shop(string $name)
    {
        $data = [
            'email' => session()->email,
            'username' => session()->username,
            'shopName' => $name,
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

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/all/products';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $productsRes = json_decode($response->getBody(), true);

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/all/feedbacks';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $feedbacksRes = json_decode($response->getBody(), true);

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/all/orders';
        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }
        $ordersRes = json_decode($response->getBody(), true);


        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/shop/name';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $shopRes = json_decode($response->getBody(), true);

        return view('shop/shop', [
            'title' => $name . "'s Shop",
            'user' => $userRes['user'],
            'name' => $name,
            'products' => $productsRes['products'],
            'feedbacks' => $feedbacksRes['feedbacks'],
            'orders' => $ordersRes['orders'],
            'shops' => $shopRes['shops'],
        ]);
    }
    public function credit($name)
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
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/admin/credits';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $credit = json_decode($response->getBody(), true);


        return view('users/credit', [
            'title' => 'Shops | ' . $name,
            'user' => $userRes['user'],
            'credit' => $credit["credits"],
            "name" => $name,
        ]);
    }

    public function UpdateCredit()
    {
        $credit = $this->request->getVar('credit');
        $shopName = $this->request->getVar('shopName');
        $ordercerdit = $this->request->getVar('ordercerdit');
        $data = [
            "shopName" => $shopName,
            "shopCredit" => $credit
        ];

        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/shop/name';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $userRes = json_decode($response->getBody(), true);
        // print_r($userRes);
        $me = (empty($userRes["shops"][0]["shopCredit"])) ? 0 : $userRes["shops"][0]["shopCredit"];
        $data["shopCredit"] = $me + $ordercerdit;
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/add/credits';
        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $datas = [
            "shopName" => $shopName,
            "creditPrice" => $credit,
            "cerditQuantity" => $ordercerdit
        ];
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/credits/orders';
        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $datas]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $userRes = json_decode($response->getBody(), true);
        return  $this->respond($userRes);
    }
}