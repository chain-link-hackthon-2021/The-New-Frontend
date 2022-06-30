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

    public function __construct()
    {
        $this->client = new HTTPClient();

        $apiEndpointsConfig = config('ApiEndpoints');
    }


    public function paypalOnbroad($id, $shopname)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v1/oauth2/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials&ignoreCache=true&return_authn_schemes=true&return_client_metadata=true&return_unconsented_scopes=true',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic QWY5OWNYZHB6bzZhNElnMnhyREZINkxBcm43UktzTV9qbHFMZ05FQmJ4WVhZNDNMdmNVWnkwck5zMVYtWWthM19maGZkbWlYQjZPRDNpNmE6RUJRaU5TMXhyVjRxblZQblhpLVVybF84Q3dEdE0ySG4zSmtwYmp3dlJOWmh5cUdwMGpiRG5lX0dWbUZub3c3NnB3TGU3RllrUnlUVWdPaGg=',
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $tokenpp = json_decode($response);
        if ($tokenpp->access_token) {
            $url = base_url('Shop/' . $shopname . '/paypal');
            $tracking = $shopname . $id;
            $dataa = " {\n    \"tracking_id\": \"$tracking\",\n    \"partner_config_override\":  {\n \"return_url\": \"$url\"} ,\n    \"operations\": [\n      {\n        \"operation\": \"API_INTEGRATION\",\n        \"api_integration_preference\": {\n          \"rest_api_integration\": {\n            \"integration_method\": \"PAYPAL\",\n            \"integration_type\": \"THIRD_PARTY\",\n            \"third_party_details\": {\n              \"features\": [\n                \"PAYMENT\",\n                \"REFUND\"\n             ]\n            }\n          }\n        }\n      }\n    ],\n    \"products\": [\n      \"PPCP\"\n    ],\n    \"legal_consents\": [\n      {\n        \"type\": \"SHARE_DATA_CONSENT\",\n        \"granted\": true\n      }\n    ]\n}";

            $dd = json_decode($dataa, true);
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://api-m.sandbox.paypal.com/v2/customer/partner-referrals');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataa);

            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: Bearer ' . $tokenpp->access_token;
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = json_decode(curl_exec($ch));
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
            return $result;
        }
    }
    public function settings(string $name)
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

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/shop/name';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }


        $shopRes = json_decode($response->getBody(), true);


        $sendview = [
            'title' => "Settings | " . $name,
            'user' => $userRes['user'],
            'shops' => $shopRes['shops'],
            'name' => $name,
            "tokenget" => '',
            'stripeID' => "",
            "stripcon" => ''

        ];
        if (empty($shopRes['shops'][0]["stripeID"])) {
            // Get user details
            $apiEndpoints = config('ApiEndpoints');
            $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/vendor/stripe/onboard';

            try {
                $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => ['shopname' => $name]]);
            } catch (BadResponseException $exception) {
                die($exception->getMessage());
            }

            $stripcon = json_decode($response->getBody(), true);
            $sendview["stripcon"] = $stripcon;
        } else {
            $sendview["stripeID"] = $shopRes['shops'][0]["stripeID"];
        }
        // print_r($stripcon);
        if (empty($shopRes['shops'][0]["MerchantId"]) || empty($shopRes['shops'][0]["TrackingId"])) {
            $sendview["tokenget"] = self::paypalOnbroad($shopRes['shops'][0]['id'], $name);
        }

        return view('settings/general', $sendview);
    }

    public function SaveSetings(string $name)
    {
        $newName = $this->request->getVar('NewShopName');
        $PayPalEnabled = $this->request->getVar('PayPalEnabled');
        $StripeEnabled = $this->request->getVar('StripeEnabled');
        $CoinbaseCommerceEnabled = $this->request->getVar('CoinbaseCommerceEnabled');

        if ($newName == $name) {
            $thename = $name;
        } else {
            $thename = $newName;
        }

        if ($PayPalEnabled == true) {
            $PayPalEnabled = 1;
        } else {
            $PayPalEnabled = 0;
        }

        if ($StripeEnabled == true) {
            $StripeEnabled = 1;
        } else {
            $StripeEnabled = 0;
        }

        if ($CoinbaseCommerceEnabled == true) {
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

    public function CryptoCurrencySettings(string $name)
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

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/shop/name';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $shopRes = json_decode($response->getBody(), true);
        $oauthxTokenEnzdpoint = $apiEndpoints->baseUrl . 'api/v1/shop/bitcoin/withdraw';

        try {
            $response = $this->client->request('POST', $oauthxTokenEnzdpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $withdraw = json_decode($response->getBody(), true);

        return view('settings/crypto', [
            'title' => "CryptoCurrency | " . $name,
            'user' => $userRes['user'],
            'shops' => $shopRes['shops'],
            'withdraw' => $withdraw['shopWithdrawals'],
            'name' => $name,
        ]);
    }

    public function Design(string $name)
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

    public function DesignNow(string $name)
    {
        helper(['form', 'url']);

        $showHelp = $this->request->getVar('ShowHelpDeskButton');
        $ShowBadges = $this->request->getVar('ShowBadges');
        $ShowProfileImage = $this->request->getVar('ShowProfileImage');
        $BannerImage = $this->request->getFile('BannerImage');
        $oldImage = $this->request->getVar('oldImage');


        if (empty($BannerImage->getName())) {
            $imageSrc = $oldImage;
        } else {
            $newName = $BannerImage->getRandomName();
            $BannerImage->move(WRITEPATH . '../public/uploads', $newName);
            $imageSrc = "/uploads/" . $BannerImage->getName();
        }

        if ($ShowBadges == true) {
            $ShowBadges = 1;
        } else {
            $ShowBadges = 0;
        }

        if ($showHelp == true) {
            $showHelp = 1;
        } else {
            $showHelp = 0;
        }

        if ($ShowProfileImage == true) {
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

        if ($updateRes['status'] === "success") {
            session()->setFlashdata('success', '<i class="lni lni-check"></i> <strong>Success!</strong> Updated. ');
        } else {
            session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> Not Updated. ');
        }
        return redirect()->back();
    }
    public function Userprofile()
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


        return view('users/userprofile', [
            'title' => "Settings | ",
            'user' => $userRes['user'],

        ]);
    }
    public function editUserProfile()
    {
        helper(['form', 'url']);
        $username = $this->request->getVar('username');
        $firstname = $this->request->getVar('firstname');
        $lastname = $this->request->getVar('lastname');
        $telephone = $this->request->getVar('telephone');
        $discordlink = $this->request->getVar('discordlink');
        if (empty($username)) {
            session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> username is required ');
            return redirect()->back();
        }
        if (empty($firstname)) {
            session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong>  firstname is required ');
            return redirect()->back();
        }
        if (empty($lastname)) {
            session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> lastname  is required ');
            return redirect()->back();
        }

        $apiEndpoints = config('ApiEndpoints');
        $userImage = $this->request->getFile('userImage');
        $oldImage = $this->request->getVar('oldImage');

        if (empty($userImage->getName())) {
            $imageSrc = $oldImage;
        } else {
            $newName = $userImage->getRandomName();
            $userImage->move(WRITEPATH . '../public/uploads/profile', $newName);
            $imageSrc = "/uploads/profile/" . $userImage->getName();
        }

        $data = [
            'email' =>  $this->request->getVar('email'),
            'username' => $username,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'display_picture' => $imageSrc,
            'telephone' => $telephone,
            'DiscordLink' => $discordlink,
        ];

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/update/single/user';

        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $productRes = json_decode($response->getBody(), true);


        if ($productRes['status'] == "success") {
            session()->setFlashdata('success', '<i class="lni lni-check"></i> <strong>Success!</strong> Profile updated!');
        } else {
            session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> An error occurred ');
        }

        return redirect()->back();
    }
    public function storeUserpayal(string $name)
    {
        helper(['form', 'url']);
        $merchantId = $this->request->getVar('merchantId');
        $merchantIdInPayPal = $this->request->getVar('merchantIdInPayPal');
        $shopname = $name;
        $data = [
            "shopName" => $shopname,
            'MerchantId' => $merchantIdInPayPal,
            'TrackingId' => $merchantId,
        ];
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/update/shop/merchantid';

        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }
        return redirect()->to("/Shop/" . $name . "/Settings");
    }
    public function storeUserbtc()
    {
        helper(['form', 'url']);
        $shopName = $this->request->getVar('shopName');
        $sellerBtc = $this->request->getVar('sellerBtc');

        $data = [
            "shopName" => $shopName,
            'coinbaseKey' => $sellerBtc,
        ];
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/vendors/add/coinbasekey';

        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }
        $productRes = json_decode($response->getBody(), true);
        //print_r($productRes);
        return redirect()->back();
    }
    public function removestoreUserbtc()
    {
        helper(['form', 'url']);
        $shopName = $this->request->getVar('shopName');

        $data = [
            "shopName" => $shopName,
            'coinbaseKey' => "",
        ];
        //   print_r($data);
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/vendors/add/coinbasekey';

        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }
        $productRes = json_decode($response->getBody(), true);
        // dd($productRes);
        return redirect()->back();
    }
    public function UpdateUserpayal()
    {
        helper(['form', 'url']);
        $shopName = $this->request->getVar('shopName');
        $data = [
            "shopName" => $shopName,
            'MerchantId' => "",
            'TrackingId' => "",
        ];
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/update/shop/merchantid';

        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }
        return redirect()->back();
    }
    public function removecrypto()
    {
        $walletadd = $this->request->getVar('walletadd');
        $amount = $this->request->getVar('amount');
        $shopName = $this->request->getVar('shopName');
        $apiEndpoints = config('ApiEndpoints');
        $data = [
            "shopName" => $shopName,
        ];
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/shop/name';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }


        $shopRes = json_decode($response->getBody(), true);
        if ($amount > $shopRes["shops"][0]['bitcoin']) {
            //more than
            echo 2;
        } else {

            $owner = $shopRes["shops"][0]['owner'];
            $oauthxTokenEndpoint = $apiEndpoints->baseUrl . "api/v1/add/shop/bitcoin";
            $datas = [
                "name" => $shopName,
                "bitcoin" => $shopRes["shops"][0]['bitcoin'] - $amount,
            ];
            try {
                $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $datas]);
            } catch (BadResponseException $exception) {
                die($exception->getMessage());
            }
            $shopRes = json_decode($response->getBody(), true);

            $oauthxTokenEndpoint = $apiEndpoints->baseUrl . "api/v1/shop/withdraw/bitcoin";
            $datas = [
                "shopOwner" => $owner,
                "shopName" => $shopName,
                "btcAddress" => $walletadd,
                "amount" => $amount,
                "status" => "pending"
            ];
            try {
                $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $datas]);
            } catch (BadResponseException $exception) {
                die($exception->getMessage());
            }
            $shopRes = json_decode($response->getBody(), true);
            // Generic response method
            return $this->respond(['status' => $shopRes['status']], 200);
        }
    }
}