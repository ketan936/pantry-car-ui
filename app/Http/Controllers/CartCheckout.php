<?php 
namespace App\Http\Controllers;
use Input;
use App;

class  CartCheckout extends Controller {

     private $cartController;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function handle()
	{	
	   $cartSummary     = CartController::getCartSummaryStaticHTML();
	   $breadcrumbParam = null;

	   $trainNum      = Input::get("train_num");
       $trainName     = Input::get("train_name");
	   $srcStation    = Input::get("source_station");
       $destStation   = Input::get("destination_station"); 
       $journeyDate   = Input::get("journey_date");
       $stationCode   = Input::get("station_code");
       $searchType    = Input::get("search_type");
       $restaurantId  = Input::get("restaurant_id");

       if(!empty($trainNum) && !empty($trainName) && !empty($journeyDate) && !empty($stationCode) ){
       	     $breadcrumbParam = Input::except("login","_token",'checkout','completeDetails');
       	     $bookingDetailHeader   = array( "DATE"              => date('D , d M Y',strtotime($journeyDate)),
				                             "TRAIN_NUM"         => $trainNum,
				                             "TRAIN_NAME"        => "<i class='fa fa-train pr10'></i>".strtoupper($trainName),
				                             "STATION_SELECTED"  => "<i class='fa fa-map-marker pr10'></i>".$stationCode
				                          );
       	     return view('cart-checkout')
                          ->with('cartSummary',$cartSummary)
                          ->with('breadcrumbParam',$breadcrumbParam)
                          ->with('bookingDetailHeader',$bookingDetailHeader);
       }
      else{
      	  App::abort(400);
      }
	}

}
