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

/*============================================================================================================*/
/*======================================== API ROUTE STRUCTURE STARTS =============================================*/
/*============================================================================================================*/

/* ========== ADD NEW ========================================================================================*/
//=========== /api/v1/add/new/--type---

/* ========== FETCH SINGLE ========================================================================================*/
//=========== /api/v1/fetch/single/--type---

/* ========== FETCH ALL ========================================================================================*/
//=========== /api/v1/fetch/all/--type---


/*============================================================================================================*/
/*======================================== API ROUTE STRUCTURE ENDS =============================================*/
/*============================================================================================================*/



class Categories extends BaseController
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

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/all/categories';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $categoriesRes = json_decode($response->getBody(), true);

        // Delete from categories table
        $deleteURL = $apiEndpoints->baseUrl . 'api/v1/delete/category';

        // Delete from products plus categories
        $deleteURL2 = $apiEndpoints->baseUrl . 'api/v1/delete/category/pro';

        return view('categories/index', [
            'title' => 'Categories',
            'user' => $userRes['user'],
            'categories' => $categoriesRes['categories'],
            'name' => $shopName,
            'deleteUrl' => $deleteURL,
            'deleteUrl2' => $deleteURL2,
        ]);
    }

    public function create(string $shopName) {
        $categoryName = $this->request->getVar('categoryName');
        $data = [
            'email' => session()->email,
            'username' => session()->username,
            'shopName' => $shopName,
            'categoryName' => $this->request->getVar('categoryName'),
        ];

        if(empty($categoryName)){
            session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> Category name must be between 2-20 chars. ');
            return redirect()->back();
        } else {
            $apiEndpoints = config('ApiEndpoints');
            $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/add/new/category';

            try {
                $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
            } catch (BadResponseException $exception) {
                die($exception->getMessage());
            }

            $createRes = json_decode($response->getBody(), true);

            if($createRes['status'] === "success"){
                ?>
                    <script>
                        window.location.href = "/Shop/<?php echo $shopName;?>/CategoryEdit/<?php echo $createRes['categoryID']; ?>"
                    </script>
                <?php
            } else {
                session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> Category was not added. ');
                return redirect()->back();
            }

        }
    }

    public function edit(string $shopName, string $categoryID) {
        $data = [
            'email' => session()->email,
            'username' => session()->username,
            'shopName' => $shopName,
            'categoryID' => $categoryID,
        ];

        $apiEndpoints = config('ApiEndpoints');
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/single/category';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }
        $categoryRes = json_decode($response->getBody(), true);

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

        $saveProductURL = $apiEndpoints->baseUrl . 'api/v1/add/new/category/product';
        $editProductURL = $apiEndpoints->baseUrl . 'api/v1/update/category';

        return view('categories/edit', [
            'title' => 'Edit Category',
            'user' => $userRes['user'],
            'category' => $categoryRes['category'],
            'products' => $productsRes['products'],
            'name' => $shopName,
            'categoryID' => $categoryID,
            'saveProductUrl' => $saveProductURL,
            'editProductUrl' => $editProductURL,
        ]);
    }

    public function editNow() {
        $apiEndpoints = config('ApiEndpoints');

        $data = [
            
        ];

        $shopName = $this->request->getVar('shopName');
        $categoryID = $this->request->getVar('categoryID');
        $categoryName = $this->request->getVar('categoryName');
        $categoryPostion = $this->request->getVar('categoryPostion');
        $products = $this->request->getVar('Products[]');
        if(empty($products) || empty($categoryPostion) || empty($categoryName) ){
            session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> All Fields are required ');
            return redirect()->back();
        } else {
            
        }
    }
}
