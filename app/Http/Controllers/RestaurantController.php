<?php namespace App\Http\Controllers;
use App\Libraries\Curl;
use Breadcrumbs;
use Input;
use Helper;
use URL;
use Session;
use Cart;

class RestaurantController extends Controller {


	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	private $curl;

	public function __construct()
	{
		$this->curl = new Curl;
	}

	private function getRestaurantMenu($restaurantId)
	{
        $url = API_HOST . MENU . $restaurantId;
        $this->curl->setOption(CURLOPT_HEADER, true);
        $this->curl->setOption(CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = $this->curl->get($url);
        $response = json_decode($response, true);
        return $response["categories"];

	}

	public function show($stationCode)
	{
       $trainNum        = Input::get("train_num");
       $trainName       = Input::get("train_name");
	   $srcStation      = Input::get("source_station");
       $destStation     = Input::get("destination_station");
       $journeyDate     = Input::get("journey_date");
       $searchType      = Input::get("search_type");
       $pnrNumber       = Input::get("pnr_number");
        $stationName    = Input::get("station_name");
        $deliveryTime   = Input::get("delivery_time");
       $breadcrumbParam = null;

       if(!empty($stationCode)){

                $restaurantHeader = "";
                $parentUrlParam   = "";
                if(!empty($journeyDate) && !empty($trainNum) &&  !empty($trainName) &&  !empty($srcStation) &&  !empty($destStation) ){
	       	   		$restaurantHeader   = array("DATE"              => $journeyDate,
				                                "ROUTE"             => "<i class='fa fa-map-marker pr10'></i>".$srcStation ." TO ". $destStation,
				                                "TRAIN_NUM"         => "<i class='fa fa-train pr10'></i> [ ".$trainNum." ] ".$trainName,
				                                "STATION_SELECTED"  => "<i class='fa fa-map-marker pr10'></i>".$stationCode
				                          );
                     $buildParam = array("train_num"           => $trainNum,
                                   		 "source_station"      => $srcStation,
                                   		 "destination_station" => $destStation,
                                   		 "journey_date"        => $journeyDate,
                                   		 "train_name"          => $trainName,
                                   		 "station_code"        => $stationCode,
                                   		 "search_type"         => $searchType,
                                         "station_name"        => $stationName,
                                         "delivery_time"        => $deliveryTime
		        			              );
                     if($searchType == "pnr_search")
		        			$buildParam['pnr_number'] = $pnrNumber;

	       	   		 $parentUrlParam    = Helper::httpBuildQuery($buildParam);
	       	   		 $breadcrumbParam   = Input::except("login","_token",'checkout','completeDetails');
                     $breadcrumbParam['station_code'] = $stationCode;
                     unset($breadcrumbParam['train_name']);
       	   	    }
                $url       = API_HOST.GET_RESTAURANT_BY_STATION_API_ROUTE.$stationCode;
		        $this->curl->setOption(CURLOPT_HEADER, true);
		        $this->curl->setOption(CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		        $response = $this->curl->get($url);
		        $response = json_decode($response,true);
		        if(isset($response) && isset($response['responseStatus']) && $response['responseStatus'] === true){
		        	if(isset($response["restaurants"])){
		        		foreach ($response["restaurants"] as $value) {
		        		   $restaurantsList[] = array("restaurantName" => $value["name"],
		        		   	 						  "restaurantUrl"  => URL::to("/")."/restaurant/".$value["url"]."?".$parentUrlParam
		        		   	                 );
		        		}
		        	}
		        }
       }

         if(isset($restaurantsList)){
		     return view('restaurant-select')
		             ->with("restaurant_header",$restaurantHeader)
		             ->with("restaurantsList",$restaurantsList)
		             ->with("breadcrumbParam",$breadcrumbParam);
		 }
		 else{
		 	 return view('restaurant-select')
		 	            ->with("breadcrumbParam",$breadcrumbParam);
		 	}
	}

	public function getDetail($restaurantId){

        if (!empty($restaurantId)) {
            $restView = null;
            $url = API_HOST . RESTAURANT;
            $this->curl->setOption(CURLOPT_HEADER, true);
            $this->curl->setOption(CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $response = $this->curl->get($url, array("url" => $restaurantId));
            $response = json_decode($response, true);
            if (isset($response) && isset($response['responseStatus']) && $response['responseStatus'] === true) {
                $restaurantMenu = $this->getRestaurantMenu($response['id']);
                $restView = view("restaurant-page")
                    ->with("showDetail", true)
                    ->with("name", $response['name'])
                    ->with("resInternalId", $response['id'])
                    ->with("stationName",Input::get("station_name"))

//                    ->with("address", $response['location']['address'])
//                    ->with("city", $response['location']['city'])
//                    ->with("state", $response['location']['state'])
                    ->with("minimumOrder", $response['minOrderValue'])
                    ->with("openTime", $response['openTime'])
                    ->with("closeTime", $response['closeTime'])
                    ->with("contactNo", $response['contactNumber'])
                    ->with("deliveryCharges", $response['deliveryCharges'])
                    ->with("restaurantMenu", $restaurantMenu);
            } else {
                return view("restaurant-page")
                    ->with("noRestFound", true);
            }
        } else {
            \App::abort(404);
        }
       $this->cleanUpCartIfNeeded($restaurantId);
       $cartController  = new CartController;
       $cartContent     = $cartController->getCartContent();
       $breadcrumbParam = null;
       $trainNum    = Input::get("train_num");
       $trainName   = Input::get("train_name");
	   $srcStation  = Input::get("source_station");
       $destStation = Input::get("destination_station");
       $journeyDate = Input::get("journey_date");
       $stationCode = Input::get("station_code");
       $searchType  = Input::get("search_type");
        $stationName    = Input::get("station_name");
        $deliveryTime   = Input::get("delivery_time");
       $restaurantHeader = null;

       $checkoutFormParamters = array("train_num" => $trainNum,
       	                              "train_name" => $trainName ,
       	                              "source_station" => $srcStation,
       	                              "destination_station" => $destStation,
       	                              "journey_date" => $journeyDate,
       	                              "station_code" => $stationCode,
       	                              "search_type" => $searchType,
       	                              "restaurant_id" => $response['id'],
       	                              "restaurant_name" => $response['name'],
		                              "delivery_charges" => $response['deliveryCharges'],
                                      "station_name" => $stationName,
                                      "delivery_time" => $deliveryTime
       	                             );
        Session::put('checkoutFormParamters',$checkoutFormParamters);


       if(!empty($journeyDate) && !empty($trainNum) &&  !empty($trainName) &&  !empty($srcStation) &&  !empty($destStation) && !empty($stationCode) && !empty($journeyDate)  && !empty($searchType)){
	       	   		$restaurantHeader   = array("DATE"              => $journeyDate,
				                                "ROUTE"             => "<i class='fa fa-map-marker pr10'></i>".$srcStation ." TO ". $destStation,
				                                "TRAIN_NUM"         => "<i class='fa fa-train pr10'></i> [ ".$trainNum." ] ".$trainName,
				                                "STATION_SELECTED"  => "<i class='fa fa-map-marker pr10'></i>".$stationCode
				                          );
	       	   		$breadcrumbParam = Input::except("login","_token",'checkout','completeDetails');
	      }
	   return $restView
	           ->with('cartContent',$cartContent)
	           ->with("breadcrumbParam",$breadcrumbParam)
	           ->with("restaurant_header",$restaurantHeader);
	}

	public function cleanUpCartIfNeeded($restaurantId){
		   if(!empty(Session::get("currentRestaurantInCart"))){
		       	   if(Session::get("currentRestaurantInCart") !== $restaurantId){
		               Cart::destroy();
		               Session::forget("checkoutFormParamters");
		       	   	 Session::set("currentRestaurantInCart",$restaurantId);
		       	   }
           }else{
       	          Session::set("currentRestaurantInCart",$restaurantId);
           }
	}



}
