<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\ApiResourceFilter;
use App\Services\ClientAuthenticator;
use CodeIgniter\API\ResponseTrait;
use Config\Services;
use Exception;
use GuzzleHttp\Client as HTTPClient;
use GuzzleHttp\Exception\BadResponseException;

class Admin extends BaseController
{
    use ResponseTrait;

    public HTTPClient $client;

    public function __construct()
    {
        $this->client = new HTTPClient();

        $apiEndpointsConfig = config('ApiEndpoints');
    }

    public function index()
    {

        echo  view('admin/inc/header', ['title' => 'AnyBuy',]);
        echo  view('admin/dashboard');
        echo  view('admin/inc/footer');
    }
    public function auth()
    {

        echo  view('admin/auth', ['title' => 'Login',]);
    }
    public function shop()
    {
        echo  view('admin/inc/header', ['title' => 'Shop',]);
        echo  view('admin/shop');
        echo  view('admin/inc/footer');
    }
    public function users()
    {
        echo  view('admin/inc/header', ['title' => 'Users',]);
        echo  view('admin/user');
        echo  view('admin/inc/footer');
    }
    public function addcredit()
    {
        echo  view('admin/inc/header', ['title' => 'Add Credit',]);
        echo  view('admin/addcredit');
        echo  view('admin/inc/footer');
    }
    public function ordercredit()
    {
        echo  view('admin/inc/header', ['title' => 'Order Credit',]);
        echo  view('admin/ordercredit');
        echo  view('admin/inc/footer');
    }
    public function vendororder()
    {
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/admin/all/orders';

        // print_r($data);
        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $responseData = json_decode($response->getBody());
        //print_r($responseData->orders[0]);
        echo  view('admin/inc/header', ['title' => 'Vendor Order',]);
        echo  view('admin/vendororder', ["orders" => $responseData->orders]);
        echo  view('admin/inc/footer');
    }
    public function notification()
    {
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/admin/all/shop';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $shops = json_decode($response->getBody(), true);
        // print_r($shops);
        echo  view('admin/inc/header', ['title' => 'Notification',]);
        echo  view('admin/notification', ["shops" => $shops["shops"]]);
        echo  view('admin/inc/footer');
    }
    public function fund()
    {
        $id = session()->id;
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/heph/user/find/{$id}';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $responseData = json_decode($response->getBody());

        // print_r($responseData);

        $status = $responseData->success;

        if ($status == 'true') {
            $userInformation = $responseData->details;

            // print_r($userInformation);

            // echo $userInformation->uniqid;

            return view('users/fund', [
                'title' => 'Fund Wallet',
                'user' => $userInformation
            ]);
        } else {
            // session()->setFlashdata('error', $responseData->description);
            return redirect()->route('home');
            // echo "Error";
        }
    }
    public function deleteUser()
    {
        $password = $this->request->getVar("password");
        $authuser = $this->request->getVar("authuser");
        $username = $this->request->getVar("username");
        $id = $this->request->getVar("id");
        if ($authuser == "femi" && $password == "femi") {
            $apiEndpoints = config('ApiEndpoints');
            $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/delete/user';
            $data = [
                'id' => $id,
                "username" => $username
            ];
            try {
                $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
            } catch (BadResponseException $exception) {
                die($exception->getMessage());
            }

            $responseData = json_decode($response->getBody());

            // print_r($responseData);

            $status = $responseData->status;
            if ($status == "success") {
                return $this->respond(2, 200);
            } else {
                return $this->respond(0, 200);
            }
        } else {
            return $this->respond(2, 200);
        }

        //print_r();
    }
    public function authverify($token)
    {
        echo  view('admin/authverify', ['title' => $token]);
    }
    public function adminLogin()
    {
        $token = $this->request->getVar("token");

        $adminID = $this->request->getVar("adminID");
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/admin/verify/key';
        $data = [
            'adminID' => $adminID,
            "token" => $token
        ];
        // print_r($data);
        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $responseData = json_decode($response->getBody());

        // print_r($responseData);

        $status = $responseData->status;

        if ($status === "success") {
            Services::session()->set([
                'AdminId' =>  $adminID,

            ]);
            return $this->respond(1, 200);
        } else {
            return $this->respond($status);
        }

        //print_r();
    }
}