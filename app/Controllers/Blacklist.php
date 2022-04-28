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

class Blacklist extends BaseController
{
	use ResponseTrait;

    public HTTPClient $client;

    public function __construct(){
        $this->client = new HTTPClient();

        $apiEndpointsConfig = config('ApiEndpoints');		
    }

    public function index(string $shopName) {
        $data = [
            'email' => session()->email,
            'username' => session()->username,
            'shopName' => $shopName,
        ];

        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/user';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $userRes = json_decode($response->getBody(), true);

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/all/blacklists';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $ticketRes = json_decode($response->getBody(), true);

        $deleteUrl = $apiEndpoints->baseUrl . 'api/v1/delete/blacklists';

        return view('blacklists/index', [
            'title' => 'Blacklist',
            'user' => $userRes['user'],
            'blacklists' => $ticketRes['blacklists'],
            'name' => $shopName,
            'deleteUrl' => $deleteUrl,
        ]);
    }

    public function add(string $shopName) {
        $data = [
            'email' => session()->email,
            'username' => session()->username,
            'shopName' => $shopName,
        ];

        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/user';
        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }
        $userRes = json_decode($response->getBody(), true);

        return view('blacklists/add', [
            'title' => 'New Blacklist',
            'user' => $userRes['user'],
            'name' => $shopName,
        ]);
    }

    public function addNow(string $shopName) {
        $BlockedData = $this->request->getVar('BlockedData');
        $data = [
            'email' => session()->email,
            'username' => session()->username,
            'shopName' => $shopName,
            'Type' => $this->request->getVar('Type'),
            'Note' => $this->request->getVar('Note'),
            'BlockedData' => $BlockedData,
        ];

        if(empty($BlockedData)){
            session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> Blocked data must be between 2-20 chars. ');
            return redirect()->back();
        } else {
            $apiEndpoints = config('ApiEndpoints');
            $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/add/new/blacklist';

            try {
                $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
            } catch (BadResponseException $exception) {
                die($exception->getMessage());
            }
            $createRes = json_decode($response->getBody(), true);
            if($createRes['status'] === "success"){
                session()->setFlashdata('success', '<i class="lni lni-check"></i> <strong>Success!</strong> Blacklist added. ');
            } else {
                session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> Blacklist was not added. ');
            }
            return redirect()->back();
        }
    }

}
