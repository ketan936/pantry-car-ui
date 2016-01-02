<?php namespace App\Http\Controllers;

use App\Libraries\Curl;
use App\Config\Constants;
class RailwaysApiController extends Controller {


	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->curl = new Curl;
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getTrainSuggestion($query)
	{

        
        $url       = TRAIN_SEARCH_API_ROUTE;
        $param     = array("q"=> $query);
        $this->curl->setOption(CURLOPT_HEADER, true);
        $this->curl->setOption(CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = $this->curl->get($url,$param); 
        $responeArray =  array("value"=>$response);
        echo json_encode($responeArray);
	}




}
