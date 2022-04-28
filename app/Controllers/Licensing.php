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

class Licensing extends BaseController
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

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/all/projects';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $projectRes = json_decode($response->getBody(), true);

        return view('licensing/index', [
            'title' => 'Projects',
            'user' => $userRes['user'],
            'projects' => $projectRes['projects'],
            'name' => $shopName,
        ]);
    }

    public function create(string $shopName) {
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

        return view('licensing/new', [
            'title' => 'New Project',
            'user' => $userRes['user'],
            'name' => $shopName,
        ]);
    }

    public function createNow(string $shopName) {
        echo $projectName = $this->request->getVar('projectName');
        echo $projectVersion = $this->request->getVar('projectVersion');
        $data = [
            'email' => session()->email,
            'username' => session()->username,
            'shopName' => $shopName,
            'projectVersion' => $projectVersion,
            'projectName' => $projectName,
        ];
        
        // Declare api endpoint
        $apiEndpoints = config('ApiEndpoints');

        // Create new project api call

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/add/new/project';
        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }
        $projectRes = json_decode($response->getBody(), true);

        if($projectRes['status'] == "success"){
            session()->setFlashdata('success', '<i class="lni lni-ban"></i> <strong>Success!</strong> New Project Added');
        } else {
            session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> An error occured while adding new project.');
        }
        return redirect()->back();        
    }

    public function licenses(string $shopName) {
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

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/all/projects';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $projectRes = json_decode($response->getBody(), true);

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/all/licenses';
        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }
        $licenseRes = json_decode($response->getBody(), true);

        return view('licensing/licenses', [
            'title' => 'Licenses',
            'user' => $userRes['user'],
            'projects' => $projectRes['projects'],
            'licenses' => $licenseRes['licenses'],
            'name' => $shopName,
        ]);
    }

    public function newLicense(string $shopName) {
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
        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/fetch/all/projects';

        try {
            $response = $this->client->request('GET', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }

        $projectRes = json_decode($response->getBody(), true);

        return view('licensing/newlicense', [
            'title' => 'New License',
            'user' => $userRes['user'],
            'projects' => $projectRes['projects'],
            'name' => $shopName,
        ]);
    }

    public function newLicenseNow(string $shopName) {
        echo $projectName = $this->request->getVar('projectName');
        echo $email = $this->request->getVar('email');
        $data = [
            'shopName' => $shopName,
            'email' => $email,
            'projectName' => $projectName,
        ];
        
        // Declare api endpoint
        $apiEndpoints = config('ApiEndpoints');

        // Create new license api call

        $oauthxTokenEndpoint = $apiEndpoints->baseUrl . 'api/v1/add/new/license';
        try {
            $response = $this->client->request('POST', $oauthxTokenEndpoint, ['json' => $data]);
        } catch (BadResponseException $exception) {
            die($exception->getMessage());
        }
        $projectRes = json_decode($response->getBody(), true);

        // if($projectRes['status'] == "success"){
        //     session()->setFlashdata('success', '<i class="lni lni-ban"></i> <strong>Success!</strong> New Project Added');
        // } else {
        //     session()->setFlashdata('error', '<i class="lni lni-ban"></i> <strong>Error!</strong> An error occured while adding new project.');
        // }
        // return redirect()->back();        
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

        $saveProductURL = $apiEndpoints->baseUrl . 'api/v1/add/category/product';
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
