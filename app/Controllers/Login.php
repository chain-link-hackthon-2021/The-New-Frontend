<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use GuzzleHttp\Client as HTTPClient;
use Config\Services;
use GuzzleHttp\Exception\BadResponseException;
use App\Controllers\BaseController;
use App\Libraries\ApiResourceFilter;
use App\Services\ClientAuthenticator;
use CodeIgniter\Files\File;
use Exception;

class Login extends BaseController
{
    use ResponseTrait;

    public HTTPClient $client;

    public function __construct()
    {
        $this->client = new HTTPClient();

        $apiEndpointsConfig = config('ApiEndpoints');
    }

    public function showLoginPage()
    {
        $apiEndpoints = config('ApiEndpoints');
        $loginUrl = $apiEndpoints->baseUrl . 'api/v1/login';

        $data = [
            'loginUrl' => $loginUrl
        ];
        return view('account/login', $data);
    }

    public function showRegisterPage()
    {
        $apiEndpoints = config('ApiEndpoints');
        $registerUrl = $apiEndpoints->baseUrl . 'api/v1/add/new/user';

        $data = [
            'registerUrl' => $registerUrl
        ];
        return view('account/register', $data);
    }

    public function initiateLogin()
    {
        $data = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
        ];

        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/login';

        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $responseData = json_decode($response->getBody());

        $status = $responseData->status;

        if ($status === "success") {
            $userInformation = $responseData->user[0];

            Services::session()->set([
                'id' => $userInformation->id,
                'username' => $userInformation->username,
                'firstName' => $userInformation->firstname,
                'lastName' => $userInformation->lastname,
                'email' => $userInformation->email,
                'active' => $userInformation->active,
            ]);
            return $responseData;
        } else {
            return $responseData;
        }
    }

    public function logout()
    {
        Services::session()->remove([
            'id',
            'username',
            'firstName',
            'lastName',
            'email',
            'active',
        ]);
        return redirect()->route('login');
    }

    public function verify(string $email, string $token)
    {
        $data = [
            'email' => $email,
            'token' => $token,
        ];

        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/verify';

        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $responseData = json_decode($response->getBody());

        $status = $responseData->status;

        if ($status === "success") {
            session()->setFlashdata('success', 'Account verified successfully');
            return redirect()->route('login');
        } else {
            session()->setFlashdata('error', $responseData->message);
            return redirect()->route('login');
        }
    }
    public function guestshop(string $name)
    {
        $data = [
            'shopName' => $name,
        ];
        $apiEndpoints = config('ApiEndpoints');
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
        } catch (BadResponseException $ex) {
            return $response = [
                'status'    => 'error',
                'code'      => 500,
                'message'   => 'Oops, looks like something went wrong',
                //'errors'    => json_decode($ex->getResponse()->getBody()->getContents(), true)
            ];
            // do something with json string...
        }
        //$resp['statusCode'] = $response->getStatusCode();

        $shopRes = json_decode($response->getBody(), true);
        //print_r($shopRes);
        if (empty($shopRes["shops"])) {
            $apiEndpoints = config('ApiEndpoints');
            $loginUrl = $apiEndpoints->baseUrl . 'api/v1/login';

            $data = [
                'loginUrl' => $loginUrl
            ];
            return view('account/login', $data);
        } else {
            return view('account/guestshop', [
                'title' => $name . "'s Shop",
                'name' => $name,
                'products' => $productsRes['products'],
                'feedbacks' => $feedbacksRes['feedbacks'],
                'orders' => $ordersRes['orders'],
                'shops' => $shopRes['shops'][0],
            ]);
        }
    }
    public function shop(string $shopName, string $productUID)
    {
        $data = [

            'name' => $shopName,
            'uniqueID' => $productUID,
            'shopName' => $shopName,
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

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/product';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $productRes = json_decode($response->getBody(), true);

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/shop/name';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $shopRes = json_decode($response->getBody(), true);

        return view('account/product', [
            'title' => "Products | " . $shopName,
            'products' => $productRes['product'],
            "name" => $shopName,
            'uniqueID' => $productUID,
            'shops' => $shopRes['shops'],
        ]);
    }
    public function shopnext(string $shopName, string $productUID, int $quantity)
    {
        $data = [
            'name' => $shopName,
            'shopName' => $shopName,
            'uniqueID' => $productUID,
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

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/product';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $productRes = json_decode($response->getBody(), true);

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/shop/name';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $shopRes = json_decode($response->getBody(), true);

        return view('account/productNext', [
            'title' => "Products | " . $shopName,
            'products' => $productRes['product'],
            "name" => $shopName,
            "quantity" => $quantity,
            'shops' => $shopRes['shops'],
        ]);
    }
    public function productorder(string $shopName, string $orderId)
    {
        $data = [


            'orderId' => $orderId,

        ];
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/orderbyid';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $userRes = json_decode($response->getBody(), true);

        if ($userRes["status"]  == "error") {
            return redirect()->to('/@' . $shopName);
            //redirect();
        } else {
            return view('account/productOrder', [
                'title' => "Products | " . $shopName,

                "name" => $shopName,
                'OrderId' => $orderId,
                'orders' => $userRes["orders"][0],
            ]);
        }
    }
}
