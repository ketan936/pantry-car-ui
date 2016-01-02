<?php 
namespace App\Http\Controllers;

class PaymentController extends Controller {

      private $cartController;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
      $this->cartController = new CartController;
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function handle()
	{	
		$cartSummary = $this->cartController->getCartSummaryStaticHTML();
        return view('payment')
              ->with('cartSummary',$cartSummary);
	}


}
