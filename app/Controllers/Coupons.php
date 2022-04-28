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

class Coupons extends BaseController
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

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/all/coupons';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $couponRes = json_decode($response->getBody(), true);
        $deleteURL = $apiEndpoints->baseUrl . 'api/v1/delete/coupon';

        return view('coupons/coupons', [
            'title' => 'Coupon',
            'user' => $userRes['user'],
            'coupons' => $couponRes['coupons'],
            'name' => $shopName,
            'deleteUrl' => $deleteURL,
        ]);
    }

    public function create(string $shopName) {
        $couponCode = $this->request->getVar('couponCode');
        $data = [
            'email' => session()->email,
            'username' => session()->username,
            'shopName' => $shopName,
            'couponCode' => $couponCode,
        ];

        if(empty($couponCode)){
            session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> Coupon Code must be between 2-20 chars. ');
            return redirect()->back();
        } else {
            $apiEndpoints = config('ApiEndpoints');
            $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/check/couponcode';

            try {
                $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
            } catch (BadResponseException $exception) {
                die($exception->getMessage());
            }

            $checkCodeRes = json_decode($response->getBody(), true);

            if($checkCodeRes['status'] == "success"){
                // Create Coupon Code

                $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/add/new/coupon';

                try {
                    $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
                } catch (BadResponseException $exception) {
                    die($exception->getMessage());
                }

                $createRes = json_decode($response->getBody(), true);

                if($createRes['status'] === "success"){
                    ?>
                        <script>
                            window.location.href = "/Shop/<?php echo $shopName;?>/CouponEdit/<?php echo $createRes['couponID']; ?>"
                        </script>
                    <?php
                } else {
                    session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> Coupon was not created. ');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> Coupon code already exists for this shop. ');
                return redirect()->back();
            }
        }
    }

    public function edit(string $shopName, string $couponID) {
        $data = [
            'email' => session()->email,
            'username' => session()->username,
            'shopName' => $shopName,
            'couponID' => $couponID,
        ];

        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/user';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $userRes = json_decode($response->getBody(), true);

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/coupon';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $couponRes = json_decode($response->getBody(), true);

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/all/products';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }
        $productsRes = json_decode($response->getBody(), true);

        return view('coupons/edit', [
            'title' => 'Edit Coupon',
            'user' => $userRes['user'],
            'coupon' => $couponRes['coupon'],
            'name' => $shopName,
            'products' => $productsRes['products'],
        ]);
    }

    public function editNow(string $shopName, string $couponID) {
        
        $couponCode = $this->request->getVar('couponCode');
        $couponProducts = $this->request->getVar('couponProducts');
        $couponDiscount = $this->request->getVar('couponDiscount');
        $couponMaxUse = $this->request->getVar('couponMaxUse');
        $data = [
            'email' => session()->email,
            'username' => session()->username,
            'shopName' => $shopName,
            'couponCode' => $couponCode,
            'couponDiscount' => $couponDiscount,
            'couponProducts' => $couponProducts,
            'couponMaxUse' => $couponMaxUse,
            'couponID' => $couponID,            
        ];

        if(empty($couponCode)){
            session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> Coupon Code must be between 2-20 chars. ');
            return redirect()->back();
        } else {
            $apiEndpoints = config('ApiEndpoints');
            $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/update/coupon';

            try {
                $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
            } catch (BadResponseException $exception) {
                die($exception->getMessage());
                session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> Coupon Code not updated. <br> An error occured!');
            }
            $createRes = json_decode($response->getBody(), true);
            if($createRes['status'] === "success"){
                session()->setFlashdata('success', '<i class="lni lni-checkmark"></i> <strong>Success!</strong> Coupon Code updated.');
            } else {
                session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> Coupon Code not updated.');
            }
            return redirect()->back();
        }
    }
}
