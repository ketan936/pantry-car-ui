<?php namespace App\Http\Controllers;

use App\Libraries\Curl;
use App\Config\Constants;
use Breadcrumbs;
use Input;
use Redirect;

class TrainController extends Controller {


	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		 $this->curl = new Curl;
	}

	public function show()
	{  
        $srcStation  = Input::get("source_station");
        $destStation = Input::get("destination_station");
        $journeyDate = Input::get("journey_date");
        $trainNum    = Input::get("train_num");
        if(empty($srcStation) || empty($destStation) || empty($destStation)){
          return view('train-select')->with("train_list","")->with("train_list_header","");

        }
        else{
           /* If train num is provided , redirect to station select direct */
            if(isset($trainNum) && !empty($trainNum))
              return Redirect::route('select.station',array("source_station"       => $srcStation ,
                                                              "destination_station" => $destStation,
                                                              "journey_date"        => $journeyDate,
                                                              "train_num"           => $trainNum,
                                                              "search_type"         => "train_search")
                                    );

            $param     =  array('src' => $srcStation,'dest' => $destStation,'date' => $journeyDate ) ;   
    	      $url       = API_HOST.TRAIN_BETWEEN_LOCATION_ROUTE;
            $this->curl->setOption(CURLOPT_HEADER, true);
            $this->curl->setOption(CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $response = $this->curl->get($url,$param); 
            $response = (array)json_decode($response);
            if(isset($response) && isset($response['status']) && $response['status'] === true && count($response['trains']) > 0) {
            	$trainListHeader        = array(  "DATE" => $response['date'],
                                                "ROUTE" => "<i class='fa fa-arrow-right pr10'></i>".$response['srcStationName'] ." [".$response['srcStationCode']."] TO " .$response['destStationName']." [".$response['destStationCode']."]",
                                                "SRC_STATION" => "<i class='fa fa-arrow-right pr10'></i>".$response['srcStationCode'],
                                                "DESTINATION_STATION" => "<i class='fa fa-arrow-right pr10'></i>".$response['destStationCode']
                                                );

               

              $trainListDetails  = array();

           	  foreach ($response['trains'] as $train) {
            		$train = (array)$train;
            		$trainListDetails[$train['trainNum']] = array(    "TRAIN_NAME"                    => $train['trainName'],
                                                                  "ARRIVAL_TIME_AT_SOURCE"        => $train['srcArrivalTime'], 
                                                                  "DEPARTURE_TIME_AT_SOURCE"      => $train['srcDepartureTime'], 
                                                                  "ARRIVAL_TIME_AT_DESTINATION"   => $train['destArrivalTime'], 
                                                                  "DEPARTURE_TIME_AT_DESTINATION" => $train['destDepartureTime']
                                                                  );
            	}

                return view('train-select')
                             ->with("train_list",$trainListDetails)
                             ->with("train_list_header",$trainListHeader);
            }
            else{
                return view('train-select')
                            ->with("train_list","")
                            ->with("train_list_header","");
            }
      }             
   }

}
