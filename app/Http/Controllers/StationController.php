<?php namespace App\Http\Controllers;

use App\Libraries\Curl;
use App\Config\Constants;
use Cocur\Slugify\Slugify;
use Breadcrumbs;
use Input;
use Helper;
use Carbon\Carbon;

class StationController extends Controller {


	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		 $this->curl       = new Curl;
		 $this->slugify    = new Slugify();
	}

	public function show()
	{
        $search_type = Input::get("search_type");
        $breadcrumbParam = null;

		if(isset($search_type)) {
            if($search_type == 'pnr_search'){
			        $pnrNumber = Input::get("pnr_number");
				    $response =  self::getPnrDetail($pnrNumber);
				    if(isset($response) && isset($response['status']) && $response['status'] === true) {
				    	$trainNum    = $response['trainNum'];
				 		$srcStation  = $breadcrumbParam['source_station'] = $response['srcStationCode'];
	        			$destStation = $breadcrumbParam['destination_station'] = $response['destStationCode'];
	        			$journeyDate = $breadcrumbParam['journey_date'] = $response['date'];
				        $breadcrumbParam['search_type'] = $search_type;
				        $breadcrumbParam['pnr_number']  = $pnrNumber;
				    }	
			      }
			 else if($search_type == 'train_search')    {
			 		$trainNum    = Input::get("train_num");
			 		$srcStation  = Input::get("source_station");
        			$destStation = Input::get("destination_station");
        			$journeyDate = Input::get("journey_date");
        			if(empty($trainNum) || empty($srcStation) || empty($destStation) || empty($destStation) || empty($journeyDate) ){
        				$response = null;
        			}
        			else{
		        		    $param     = array('src' => $srcStation,'dest' => $destStation,'date' => $journeyDate ,'train' => $trainNum) ; 
						    $url       = API_HOST.STATION_BETWEEN_LOCATION_ROUTE;
					        $this->curl->setOption(CURLOPT_HEADER, true);
					        $this->curl->setOption(CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
					        $response = $this->curl->get($url,$param);
					        $response = (array)json_decode($response);

					        $breadcrumbParam = Input::except("login","_token",'checkout','completeDetails');
        			}
			  }  
			  else{
			  	 $response = null;
			  }

		   

		  if(isset($response) && isset($response['status']) && $response['status'] === true) {
		      	 
		        	  $stationHeader       = array( "journey_date"        => "<i class='fa fa-calendar pr10'></i>".date('d M Y' ,strtotime($response['date'])),
		        	 	                             "route"              => "<i class='fa fa-map-marker pr10'></i>".$response['srcStationName'] ." TO " .$response['destStationName'],
		        	 	                             "train_name"         => "<i class='fa fa-train pr10'></i> [ ".$response['trainNum'] ." ] ".$response['trainName']
		        	 	                            );
		        	                          
		        	
		        	$stationsListDetails  = array();
		        	foreach ($response['trainStoppages'] as $station) {
		        		$station = (array)$station;
		        		$buildParam = array("train_num"           => $trainNum,
                                   			"source_station"      => $srcStation,
                                   			"destination_station" => $destStation,
                                   			"journey_date"        => $journeyDate,
                                   			"train_name"          => $response['trainName'],
                                   			"search_type"		  => $search_type,
											"station_name"		  => $station["stationName"],
											"delivery_time"		  => $this->calculateTime($station,$journeyDate)
	 	        			                  );
		        		if($search_type == "pnr_search")
		        			$buildParam['pnr_number'] = $pnrNumber;
		        		$parentUrlParam    = Helper::httpBuildQuery($buildParam);
		        		$eachStationSeoUrl = "restaurants/".$station['stationCode']."/".$this->slugify->slugify("restaurants near by ".$station['stationName']. " railway station ")."?".$parentUrlParam;
		        		$stationsListDetails[$station['stationCode']] = array("STATION_NAME" => $station['stationName'],
		        															  "ARRIVAL_TIME" => $station['arrivalTime'], 
		        															  "HALT" => $station['stoppageTime'],
		        															  "DAY" =>"DAY " .$station['day'],
		        															  "stationSeoUrl" => $eachStationSeoUrl
		        															 );
		        	}
		            return view('station-select')
		                       ->with("station_list",$stationsListDetails)
		                       ->with("station_header",$stationHeader)
		                       ->with("breadcrumbParam",$breadcrumbParam);
		       }
		      else{
		        	  return view('station-select')
		        	         ->with("station_list","")
		        	         ->with("station_header","")
		        	         ->with("breadcrumbParam",$breadcrumbParam);
		        } 

		}
		else{
			return view('station-select')
			       ->with("station_list","")
			       ->with("station_header","")
			       ->with("breadcrumbParam",$breadcrumbParam);
		}
            
	}

	public function getPnrDetail($pnrNumber){
                    if(isset($pnrNumber) && !empty($pnrNumber)){
                    	$url       = API_HOST.PNR_DETAIL_ROUTE.$pnrNumber;
				        $this->curl->setOption(CURLOPT_HEADER, true);
				        $this->curl->setOption(CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
				        $response = $this->curl->get($url); 
				        $response = json_decode($response,true);
                    }
				    else{
				    	$response =  array("status" => "false");
				    }

				    return $response;
	}

	public function calculateTime($station,$journeyDate){
		 return Carbon::createFromFormat('d-m-Y H:i:s',$journeyDate
			 ." "
			 .($station["arrivalTime"] == "Start" ? $station["departureTime"] : $station["arrivalTime"])
			 .":00"
		 )
			 ->setTimezone("Asia/Kolkata")
			 ->addDays($station["day"] -1)->toDateTimeString();


	}

}
