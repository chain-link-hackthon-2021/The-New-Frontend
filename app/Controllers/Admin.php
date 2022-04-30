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
        echo  view('admin/inc/header', [
            'title' => 'AnyBuy',
        ]);
        echo  view('admin/dashboard');
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
}