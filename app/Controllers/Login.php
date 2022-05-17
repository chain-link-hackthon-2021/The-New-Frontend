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
            "url" => $apiEndpoints->baseUrl,
        ]);
    }
    public function productorder(string $shopName, string $orderId)
    {
        $data = [

            'shopName' => $shopName,
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
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/shop/name';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $shopRes = json_decode($response->getBody(), true);
        if ($userRes["status"]  == "error") {
            return redirect()->to('/@' . $shopName);
            //redirect();
        } else {
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
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v1/customer/partners/CALDATTYR5AJE/merchant-integrations/' . $shopRes['shops'][0]['MerchantId'],
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',

                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Bearer ' . $tokenpp->access_token
                    ),
                ));
                $response = curl_exec($curl);

                curl_close($curl);
                $res = json_decode($response, true);
            }
            return view('account/productOrder', [
                'title' => "Products | " . $shopName,
                'shops' => $shopRes['shops'],
                "name" => $shopName,
                'OrderId' => $orderId,
                'orders' => $userRes["orders"][0],
                "url" => $apiEndpoints->baseUrl,
                "partner_client_id" => $res["oauth_integrations"][0]["oauth_third_party"][0]["partner_client_id"]
            ]);
        }
    }
    public function productorderbtc(string $shopName, string $orderId)
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

            if (empty($userRes["orders"][0]["btc_address"])) {
                $oauthxTokenEndpoints = $apiEndpoints->baseUrl . 'api/v1/update/order/btc';
                $address =  self::getWallet();
                $data["btc_address"] = $address;
                try {
                    $response = $this->client->request('POST', $oauthxTokenEndpoints, ['json' => $data]);
                } catch (BadResponseException $exception) {
                    die($exception->getMessage());
                }
                $apiEndpoints = config('ApiEndpoints');
                $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/orderbyid';

                try {
                    $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
                } catch (BadResponseException $exception) {
                    die($exception->getMessage());
                }

                $userRes = json_decode($response->getBody(), true);
            }


            return view('account/productOrderbtc', [
                'title' => "Products | " . $shopName,

                "name" => $shopName,
                'OrderId' => $orderId,
                'orders' => $userRes["orders"][0],
            ]);
        }
    }

    public function loadbtccon($amount)
    {


        try {
            $response = $this->client->request('GET', "https://blockchain.info/tobtc?currency=USD&value=" . $amount . "");
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $result = json_decode($response->getBody(), true);
        return $result;
    }
    public function getbtcPayment()
    {
        $invoice_id = $_GET['invoice_id']; //invoice_id is passed back to
        // the callback URL
        $transaction_hash = $_GET['confirmations'];
        $value_in_satoshi = $_GET['value'];
        $value_in_btc = $value_in_satoshi / 100000000;
        if ($_GET['confirmations'] > 6) {
            echo "*ok*";
        }
        //Commented out to test, uncomment when live
        // if ($_GET['test'] == true) {
        //   return
        // }

        echo "*ok*";
    }
    public function getWallet()
    {
        $url = "https://api.blockchain.info/v2/receive?";
        $api_key = "1666eca2-5dda-4f69-9834-832f4ca5df4d";
        $gap_limit = "120";
        $callback = urlencode("https://mystore.com?invoice_id=058921123");
        $blockchain_xpub = "xpub6DQm9YnKmRSepqp7LRf5kAAba1aqfyuKNAaAV8QG9tnmxukZNoRHftkhjVwiYBtVch1DWy8b9LCtQ4gPUBbctpk7JzKZMj7pYDkqnqfU5g4";
        try {
            $response = $this->client->request('GET',  $url . 'xpub=' . $blockchain_xpub . '&callback=' . $callback . '&key=' . $api_key . '&gap_limit=' . $gap_limit . '');
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $result = json_decode($response->getBody(), true);
        return $result["address"];
    }
    public function getDepositBalance()
    {
        //echo "efefsd";
        $address =  $this->request->getVar('address');
        $orderId = $this->request->getVar('orderId');
        $shopName = $this->request->getVar('shopName');
        if ($address == "") {
            print 0;
        } else {
            $confirm = "?confirmations=6";
            $url = "https://blockchain.info/q/addressbalance/";
            // $address = $addres;
            try {
                $response = $this->client->request('GET', $url . $address . $confirm);
            } catch (BadResponseException $exception) {
                die($exception->getMessage());
            }

            $result = json_decode($response->getBody(), true);
            return  $this->respond($result);
            // $loadresult = json_decode($result);
            // echo $loadresult;
        }
    }
    public function confirmBalance()
    {
    }
    public function completePayment($orderId)
    {
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/orderbyid';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => ["orderId" => $orderId]]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $userRes = json_decode($response->getBody(), true);
        return view("account/completedpay", ['title' => "Products | ", "orders" => $userRes["orders"][0]]);
    }
    public function UpdateBtcOrder()
    {
        $data = [
            "shopName" => $this->request->getVar('shopName'),
            "productId" => $this->request->getVar('productId'),
            "productName" => $this->request->getVar('productName'),
            "orderId" => $this->request->getVar('orderId'),
            "stock" => $this->request->getVar('stock')
        ];
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/product';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => ["uniqueID" => $data["productId"]]]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }
        $userRes = json_decode($response->getBody(), true);

        $newstock = $userRes["product"][0]["stock"] - $data["stock"];
        $newstock;
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/update/order/status';

        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => ["orderId" => $data["orderId"], "orderStatus" => "completed"]]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/shop/name';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $credit = json_decode($response->getBody(), true);
        // print_r($userRes);
        $me = (empty($credit["shops"][0]["shopCredit"])) ? 0 : $credit["shops"][0]["shopCredit"];
        $data["shopCredit"] = $me - 1;
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/add/credits';
        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $userRes = json_decode($response->getBody(), true);

        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/update/product/stock';

        try {
            $responsea = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => ["productId" => $data["productId"], "stock" => $newstock]]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $result = json_decode($responsea->getBody(), true);
        return  $this->respond($result);
        //email notification here
    }
}