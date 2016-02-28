<?php 
namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Libraries\Curl;
use App\Config\Constants;
use Illuminate\Support\Facades\Input;
use Log;
use Auth;
use Session;
use Carbon\Carbon;
use Redirect;

class PaymentController extends Controller {

      private $cartController;
	  private $curl;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
        $this->curl = new Curl;
        $this->cartController = new CartController;
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function handle()
	{
        $url       = API_HOST.CREATE_ORDER;
        $this->curl->setOption(CURLOPT_HEADER, true);
        $this->curl->setOption(CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $request = $this->createRequest();
        $response = $this->curl->post($url,json_encode($request));
        Log::info($response);
        $response = json_decode($response,true);
        $url       = API_HOST.ORDER.$response["order_id"].CHECKOUT;
        $checkoutResponse =  $this->curl->put($url,json_encode($request));
        Log::info($checkoutResponse);
        $checkoutResponse = json_decode($checkoutResponse,true);
        if(Input::get("payment_mode") == "COD"){
           return redirect("orderPlaced")->with("checkoutResponse",$checkoutResponse);
        }
        return redirect($checkoutResponse["payment_url"]);
//        $cartSummary = $this->cartController->getCartSummaryStaticHTML();
//        return view('payment')
//              ->with('cartSummary',$cartSummary);
	}

    private function  createRequest(){
        $checkoutParameter = Session::get("checkoutFormParamters");
        $cart = Cart::content();
        $user = Auth::user();
        $request = array(
            "customer_id" => $user->getAuthIdentifier(),
            "restaurant_id" => $checkoutParameter["restaurant_id"],
            "train_no" => $checkoutParameter["train_num"],
            "station_code" => $checkoutParameter["station_code"],
            "order_date" => Carbon::now()->timezone("Asia/Kolkata")->toDateTimeString(),
            "delivery_date" => $checkoutParameter["delivery_time"],
            "amount_billed" =>Cart::total(),
            "mode_of_payment" => Input::get("payment_mode") == "COD" ? "COD" :"PREPAID",
            "order_items" => $this->createOrderItem($cart)
        );
        $checkoutParameter["mode_of_payment"] = $request ["mode_of_payment"];
        Session::put("checkoutFormParamters", $checkoutParameter);
        return $request;
    }

    private  function createOrderItem($content){
        $orderItems = array();
        foreach($content as $row)
        {
            array_push(
                $orderItems , array(
                    "menu_item_id" => $row->id,
                    "name" => $row->name,
                    "quantity" => $row->qty,
                    "per_item_cost" => $row->price
                ));
        }
        return $orderItems;
    }

    public function placed()
    {
        Session::get("checkoutResponse");
    }



}
/*
result = {array} [9]
 train_num = "12206"
 train_name = "NANDA DEVI EXP"
 source_station = "DDN"
 destination_station = "NDLS"
 journey_date = "26-02-2016"
 station_code = "NDLS"
 search_type = "train_search"
 restaurant_id = "al-barista-16"
 restaurant_name = "Al Barista"


     items = {array} [7]
 rowid = "027c91341fd5cf4d2579b49c4b6a90da"
 id = "1"
 name = "Veg Thali"
 qty = 1
 price = "160"
 options = {Gloudemans\Shoppingcart\CartRowOptionsCollection} [1]
 subtotal = 160*/
