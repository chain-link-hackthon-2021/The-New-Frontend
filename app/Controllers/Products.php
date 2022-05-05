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

class Products extends BaseController
{
    use ResponseTrait;

    public HTTPClient $client;

    public function __construct()
    {
        $this->client = new HTTPClient();

        $apiEndpointsConfig = config('ApiEndpoints');
    }

    public function showProducts(string $name)
    {
        $data = [
            'email' => session()->email,
            'username' => session()->username,
            'name' => $name,
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
        // ENDS

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/shop/top/products';

        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
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

        return view('products/products', [
            'title' => "Products | " . $name,
            'products' => $ordersRes['products'],
            'user' => $userRes['user'],
            "name" => $name,
            'shops' => $shopRes['shops'],
        ]);
    }

    public function createProduct(string $name)
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

        return view('products/createproduct', [
            'title' => "New Product | " . $name,
            'user' => $userRes['user'],
            'name' => $name,
        ]);
    }

    public function createProductNow(string $shopName)
    {
        $data = [
            'shopName' => $shopName,
            'name' => $this->request->getVar('ProductName'),
        ];

        // Add shop's product

        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/add/new/product';

        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $productRes = json_decode($response->getBody(), true);

        $stat = $productRes['status'];

        if ($stat == 'success') {
            session()->setFlashdata('success', 'New Product Added');
        } else {
            session()->setFlashdata('error', 'Product not aadded');
        }

        return redirect()->back();
    }

    public function editProduct(string $shopName, string $productUID)
    {
        $data = [
            'uniqueID' => $productUID,
            'email' => session()->email,
            'username' => session()->username,
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

        // Get product details

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

        return view('products/editProduct', [
            'title' => 'Edit Product',
            'user' => $userRes['user'],
            'name' => $shopName,
            'products' => $productRes,
            'shops' => $shopRes['shops'],
            'uniqueID' => $productUID,
        ]);
    }

    public function editProductNow(string $shopName, string $productUID)
    {
        helper(['form', 'url']);
        $price = $this->request->getVar('ProductPrice');
        $productType = $this->request->getVar('ProductType');
        $description = $this->request->getVar('description');
        if (empty($price)) {
            session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> Product Price is required ');
            return redirect()->back();
        }
        if (empty($productType)) {
            session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> Product Type is required ');
            return redirect()->back();
        }
        if (empty($description)) {
            session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> Product Description is required ');
            return redirect()->back();
        }

        $apiEndpoints = config('ApiEndpoints');
        $productImage = $this->request->getFile('productImage');
        $oldImage = $this->request->getVar('oldImage');

        if (empty($productImage->getName())) {
            $imageSrc = $oldImage;
        } else {
            $newName = $productImage->getRandomName();
            $productImage->move(WRITEPATH . '../public/uploads/products', $newName);
            $imageSrc = "/uploads/products/" . $productImage->getName();
        }

        $data = [
            'uniqueID' => $productUID,
            'username' => session()->username,
            'productPrice' => $this->request->getVar('ProductPrice'),
            'description' => $this->request->getVar('description'),
            'productType' => $this->request->getVar('ProductType'),
            'stripeEnabled' => $this->request->getVar('StripeEnabled'),
            'coinbaseCommerceEnabled' => $this->request->getVar('CoinbaseCommerceEnabled'),
            'payPalEnabled' => $this->request->getVar('PayPalEnabled'),
            'position' => $this->request->getVar('Position'),
            'webhookUrl' => $this->request->getVar('WebhookUrl'),
            'callbackURL' => $this->request->getVar('CallbackURL'),
            'StockCount' => $this->request->getVar('StockCount'),
            'productImage' => $imageSrc,
            'stock' => $this->request->getVar('stock'),
        ];

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/update/product';

        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $productRes = json_decode($response->getBody(), true);


        if ($productRes['status'] == "success") {
            session()->setFlashdata('success', '<i class="lni lni-check"></i> <strong>Success!</strong> Product updated!');
        } else {
            session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> An error occurred ');
        }

        return redirect()->back();
    }

    public function topProducts(string $name)
    {
        $data = [
            'username' => session()->username,
            'name' => $name,
        ];

        // Get user details
        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/shop/top/products';

        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $shopRes = json_decode($response->getBody(), true);

        $status = $shopRes['status'];
        return view('shop/top-products', [
            'user' => $shopRes['products'],
        ]);
    }

    public function productFace(string $shopName, string $productUID)
    {
        $data = [
            'username' => session()->username,
            'name' => $shopName,
            'email' => session()->email,
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

        return view('products/productFace', [
            'title' => "Products | " . $shopName,
            'products' => $productRes['product'],
            'user' => $userRes['user'],
            "name" => $shopName,
            'uniqueID' => $productUID,
            'shops' => $shopRes['shops'],
        ]);
    }

    public function productNextFace(string $shopName, string $productUID, int $quantity)
    {
        $data = [
            'username' => session()->username,
            'name' => $shopName,
            'shopName' => $shopName,
            'email' => session()->email,
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

        return view('products/productNextFace', [
            'title' => "Products | " . $shopName,
            'products' => $productRes['product'],
            'user' => $userRes['user'],
            "name" => $shopName,
            "quantity" => $quantity,
            'shops' => $shopRes['shops'],
        ]);
    }

    public function ApplyCoupon(string $shopName)
    {
        $couponCode = $this->request->getVar('couponCode');
        $currentPrice = $this->request->getVar('price');
        $productID = $this->request->getVar('productID');
        if (empty($currentPrice) || empty($couponCode)) {
            return json_encode([
                'status' => 'error',
                'message' => 'Provide all parameters',
            ]);
        } else {
            $data = [
                'shopName' => $shopName,
                'couponCode' => $couponCode,
            ];
            $apiEndpoints = config('ApiEndpoints');
            $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/coupon/p';

            try {
                $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
            } catch (BadResponseException $exception) {
                die($exception->getMessage());
            }

            $couponRes = json_decode($response->getBody(), true);

            if ($couponRes['status'] == 'success') {
                if ($couponRes['coupon'][0]['couponMaxUse'] <= $couponRes['coupon'][0]['couponUses']) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Coupon expired',
                    ]);
                } else {
                    $couponProducts = $couponRes['coupon'][0]['couponProducts'];
                    $productList = explode(";", $couponProducts);

                    $couponDiscount = $couponRes['coupon'][0]['couponDiscount'];

                    if (in_array($productID, $productList)) {
                        $discountDigit = $couponDiscount / 100;
                        $new = $currentPrice - ($currentPrice * $discountDigit);
                        echo json_encode([
                            'status' => 'success',
                            'newPrice' => $new,
                            "couponAmount" => $discountDigit,
                            "discount" => $couponDiscount,
                            'couponID' => $couponRes['coupon'][0]['couponID'],
                            'couponUses' => $couponRes['coupon'][0]['couponUses'],
                        ]);
                    } else {
                        return json_encode([
                            'status' => 'error',
                            'message' => 'Coupon not applicable to product',
                        ]);
                    }
                }
            } else {
                return json_encode([
                    'status' => 'error',
                    'message' => 'Invalid Coupon Code',
                ]);
            }
        }
    }
}