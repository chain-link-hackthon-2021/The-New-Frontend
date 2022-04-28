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

class Settings extends BaseController
{
	use ResponseTrait;

    public HTTPClient $client;

    public function __construct(){
        $this->client = new HTTPClient();

        $apiEndpointsConfig = config('ApiEndpoints');		
    }
    public function settings(string $name) {
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

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/shop/name';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $shopRes = json_decode($response->getBody(), true);

        return view('settings/general', [
            'title' => "Settings | " . $name,
            'user' => $userRes['user'],
            'shops' => $shopRes['shops'],
            'name' => $name,
        ]);
    }

    public function SaveSetings(string $name) {
        $newName = $this->request->getVar('NewShopName');
        $PayPalEnabled = $this->request->getVar('PayPalEnabled');
        $StripeEnabled = $this->request->getVar('StripeEnabled');
        $CoinbaseCommerceEnabled = $this->request->getVar('CoinbaseCommerceEnabled');

        if($newName == $name){
            $thename = $name;
        } else {
            $thename = $newName;
        }

        if($PayPalEnabled == true){
            $PayPalEnabled = 1;
        } else {
            $PayPalEnabled = 0;
        }

        if($StripeEnabled == true){
            $StripeEnabled = 1;
        } else {
            $StripeEnabled = 0;
        }

        if($CoinbaseCommerceEnabled == true){
            $CoinbaseCommerceEnabled = 1;
        } else {
            $CoinbaseCommerceEnabled = 0;
        }
        $data = [
            'email' => session()->email,
            'username' => session()->username,
            'shopName' => $name,
            'NewShopName' => $thename,
            'Description' => $this->request->getVar('Description'),
            'SupportEmail' => $this->request->getVar('SupportEmail'),
            'DiscordLink' => $this->request->getVar('DiscordLink'),
            'CurrencyType' => $this->request->getVar('CurrencyType'),
            'CustomDomain' => $this->request->getVar('CustomDomain'),
            'TawkSiteId' => $this->request->getVar('TawkSiteId'),
            'SellerNotes' => $this->request->getVar('SellerNotes'),
            'PayPalEnabled' => $PayPalEnabled,
            'StripeEnabled' => $StripeEnabled,
            'CoinbaseCommerceEnabled' => $CoinbaseCommerceEnabled,
        ];
        print_r($data);

        // Get user details
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/update/shop/generalSetting';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $userRes = json_decode($response->getBody(), true);

        // rename shop in user
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/rename/shop/general/categories';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        print_r($userRes);
    }

    public function CryptoCurrencySettings(string $name) {
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

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/shop/name';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $shopRes = json_decode($response->getBody(), true);

        return view('settings/crypto', [
            'title' => "CryptoCurrency | " . $name,
            'user' => $userRes['user'],
            'shops' => $shopRes['shops'],
            'name' => $name,
        ]);
    }

    public function Design(string $name) {
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
        
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/shop/name';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $shopRes = json_decode($response->getBody(), true);

        return view('settings/design', [
            'title' => "Design | " . $name,
            'user' => $userRes['user'],
            'shops' => $shopRes['shops'],
            'name' => $name,
        ]);
    }

    public function DesignNow(string $name) {
        helper(['form', 'url']);

        $showHelp = $this->request->getVar('ShowHelpDeskButton');
        $ShowBadges = $this->request->getVar('ShowBadges');
        $ShowProfileImage = $this->request->getVar('ShowProfileImage');
        $BannerImage = $this->request->getFile('BannerImage');
        $oldImage = $this->request->getVar('oldImage');


        if(empty($BannerImage->getName())){
            $imageSrc = $oldImage;
        } else {
            $newName = $BannerImage->getRandomName();
            $BannerImage->move(WRITEPATH . '../public/uploads', $newName);
            $imageSrc = "/uploads/" . $BannerImage->getName();
        }

        if($ShowBadges == true){
            $ShowBadges = 1;
        } else {
            $ShowBadges = 0;
        }

        if($showHelp == true){
            $showHelp = 1;
        } else {
            $showHelp = 0;
        }

        if($ShowProfileImage == true){
            $ShowProfileImage = 1;
        } else {
            $ShowProfileImage = 0;
        }
        
        $data = [
            'email' => session()->email,
            'username' => session()->username,
            'shopName' => $name,
            'imageSrc' => $imageSrc,
            'showHelp' => $showHelp,
            'ShowBadges' => $ShowBadges,
            'displayImage' => $ShowProfileImage,
        ];

        // update shop details
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/update/shop/design';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $updateRes = json_decode($response->getBody(), true);
        
        if($updateRes['status'] === "success"){
            session()->setFlashdata('success', '<i class="lni lni-check"></i> <strong>Success!</strong> Updated. ');
        } else {
            session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> Not Updated. ');
        }
        return redirect()->back();
    }
}