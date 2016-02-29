<?php
namespace App\Http\Controllers;

use App\Libraries\Curl;
use App\Config\Constants;
use Illuminate\Support\Facades\Input;
use Log;
use Auth;
use Session;
use Carbon\Carbon;
use Redirect;
use Cart;

class PaymentController extends Controller
{

    private $curl;

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
    public function handle()
    {
        $url = API_HOST . CREATE_ORDER;
        $this->curl->setOption(CURLOPT_HEADER, true);
        $this->curl->setOption(CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $request = $this->createRequest();
        $response = $this->curl->post($url, json_encode($request));
        Log::info($response);
        $response = json_decode($response, true);
        $url = API_HOST . ORDER . $response["order_id"] . CHECKOUT;
        $checkoutResponse = $this->curl->put($url, json_encode($request));
        Log::info($checkoutResponse);
        $checkoutResponse = json_decode($checkoutResponse, true);
        if (Input::get("payment_mode") == "COD") {
            return redirect("orderPlaced?order_id=" . $checkoutResponse["order_id"])->with("checkoutResponse", $checkoutResponse);
        }
        return redirect($checkoutResponse["payment_url"]);
    }

    private function createRequest()
    {
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
            "amount_billed" => Cart::total(),
            "mode_of_payment" => Input::get("payment_mode") == "COD" ? "COD" : "PREPAID",
            "order_items" => $this->createOrderItem($cart)
        );
        $checkoutParameter["mode_of_payment"] = $request ["mode_of_payment"];
        Session::put("checkoutFormParamters", $checkoutParameter);
        return $request;
    }

    private function createOrderItem($content)
    {
        $orderItems = array();
        foreach ($content as $row) {
            array_push(
                $orderItems, array(
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
        if (Session::has("checkoutResponse"))
            $this->removeAllTrace();

        $orderDetail = $this->getOrderDetail(Input::get("order_id"));
        $cartSummary = $this->getCartSummaryStaticHTML($orderDetail);

        return view('payment')
            ->with('cartSummary', $cartSummary)
            ->with("orderDetail" , $orderDetail);
    }

    private function getOrderDetail($orderId)
    {
        $url = API_HOST . ORDER . $orderId;
        $this->curl->setOption(CURLOPT_HEADER, true);
        $this->curl->setOption(CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response =  json_decode($this->curl->get($url),true);
        return $response;
    }

    private function removeAllTrace()
    {
        Session::forget("checkoutFormParamters");
        Cart::destroy();
    }

    private function getCartSummaryStaticHTML($orderDetail)
    {
        $content = $orderDetail["order_items"];
        $cartString = "<ul class='cart-summary'>";
        $iterator = 0;

        foreach ($content as $row) {
            $cartString .= "<li data-index='" . $iterator . "'>";
            $cartString .= '<div class="cart-item-name" >' . $row["name"] . '</div>';
            $cartString .= '<div class="cart-item-qty pt5" >x ' . $row["quantity"] . '</div>';
            $cartString .= '<div class="cart-item-total textright pr10">Rs ' . $row["quantity"] *  $row["per_item_cost"] . '</div>';
            $cartString .= '</li>';
            $iterator++;
        }

        $cartString .= "</ul>";
        $cartString .= '<div class="payment-total mt20 overflow-hidden"><span class="floatleft">Amount Payable</span><span class="floatright" >Rs ' . $orderDetail["amount_billed"] . '</span></div>';
        return $cartString;
    }
}