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
            "url" => $this->client,
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

        // Get user details end

        return view('users/dashboard', [
            'title' => "Dashboard | " . $name,
            'user' => $userRes['user'],
            "name" => $name,
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

        return view('users/create', [
            'title' => 'Shops',
            'user' => $userRes['user'],
        ]);
    }

    public function createShopNow()
    {
        $data = [
            'username' => session()->username,
            'name' => $this->request->getVar('Name'),
        ];

        // Add user's shops

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
        ];

        // Get user details
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/top/products';

        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $shopRes = json_decode($response->getBody(), true);

        $status = $shopRes['status'];
        return view('shop/box-disputes', [
            'user' => $shopRes['products'],
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
}
