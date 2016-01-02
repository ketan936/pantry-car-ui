<?php namespace App\Http\Controllers;

use App\Libraries\Curl;
use App\Config\Constants;
use Illuminate\Auth\GenericUser;;
use Auth;

class RegisterController extends Controller {

  private $curl;

	public function __construct()
	{
		$this->curl = new Curl;
	}

   public function store($data){

        $url       = API_HOST.SIGNUP_API_ROUTE;
   	    $this->curl->setOption(CURLOPT_HEADER, true);
        $this->curl->setOption(CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = $this->curl->post($url, json_encode($data));
        $responseResultDecode =  (array)json_decode($response);
        if(isset($responseResultDecode) && isset($responseResultDecode['emailId']) &&  isset($responseResultDecode['name']) ){
          $userArray = new GenericUser(array("id" => $responseResultDecode['emailId'],"name" => $responseResultDecode['name']));
          Auth::login($userArray);
          return true;
        }
        
        return false;  
   }

}
