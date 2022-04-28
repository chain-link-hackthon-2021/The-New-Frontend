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

class Storefront extends BaseController
{
	use ResponseTrait;

    public HTTPClient $client;

    public function __construct(){
        $this->client = new HTTPClient();

        $apiEndpointsConfig = config('ApiEndpoints');		
    }
}
