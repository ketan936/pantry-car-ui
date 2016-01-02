<?php 
namespace App\Http\Controllers;
use Meta;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

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
	public function index()
	{	
        return view('home');
	}

	public function doLogin()
	{
		return view('login');
	}

    public function signup()
	{
		return view('signup');
	}
    public function aboutUsPage(){
    	return view('about-us');
    }
    public function contactUsPage(){
    	return view('contact-us');
    }
    public function orderTrackerPage(){
   	   return view('order-tracker');
   }
   public function merchantPage(){
   	   return view('merchants');
   }
   public function location(){
   	   return view('location');
   }
}
