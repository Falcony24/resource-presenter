<?php

namespace App\Http\Controllers;

require_once(__DIR__ . "../../../../vendor/autoload.php");

use Dotenv\Dotenv;
use Illuminate\Http\Request;

class TestApiController extends Controller
{
    public function index(){
        $response = file_get_contents("http://dataservices.imf.org/REST/SDMX_JSON.svc/DataStructure/PCPS");

        $data = json_decode($response);

//        $data = (array) $data;

//["Structure"]["CodeLists"]["CodeList"][3]["Code"]
        return view('testApi', ['info' => $data->Structure->CodeLists->CodeList[3]->Code ]);
    }
}
