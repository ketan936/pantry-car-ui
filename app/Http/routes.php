<?php
use App\Config\Constants;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('/', 'HomeController@index');

Route::get('/login', function() {
	 if(Auth::guest()) {
	       $previousUrl = URL::to('/');
	       $nextUrl     = Helper::httpBuildUrl($previousUrl,array("query" => "login=1"),HTTP_URL_JOIN_QUERY);
	       return Redirect::to($nextUrl);
      } 
    else{
    	return Redirect::to('/');
    }  
});

Route::get('/logout', function() {
	 Auth::logout();
     return Redirect::to('/');
});

Route::get('/signup', function() {
     return Redirect::to('/')->with('signup', 1);
});

Route::get('facebook', 'Auth\AuthController@facebook_redirect');

Route::get('account/facebook', 'Auth\AuthController@facebook');

Route::get('google', 'Auth\AuthController@google_redirect');

Route::get('account/google', 'Auth\AuthController@google');

Route::post('login', array('uses'=>'Auth\AuthController@login','as' => 'login.form'));

Route::post('signup', 'Auth\AuthController@signup');

Route::get('/terms-and-conditons', 'HomeController@tncPage');

Route::get('/privacy-policy', 'HomeController@privacyPolicyPage');

Route::get('/disclaimer', 'HomeController@disclaimerPage');

Route::get('/contact-us', 'HomeController@contactUsPage');

Route::get('/about-us', 'HomeController@aboutUsPage');

Route::get('/locations', 'HomeController@location');

Route::get('/order-tracker','HomeController@orderTrackerPage');

Route::get("/merchants","HomeController@merchantPage");

Route::get('/complaints', 'HomeController@complaintsPage');

Route::get('/selectStation',array('as' => 'select.station', 'uses' => 'StationController@show'));

Route::get('/selectTrain',array('as'=>'select.train' ,'uses' =>'TrainController@show'));

Route::get("/profile","ProfileController@show");

Route::get("/viewCart","CartController@show");

Route::get('/getTrainSuggestion/{query}',"RailwaysApiController@getTrainSuggestion");

Route::get('account/activate/{code}',array('as'   => 'activate-account','uses' => 'Auth\AuthController@activateAccount'));

Route::get('passwordReset/{code}',array('as'   => 'password-reset','uses' => 'Auth\AuthController@passwordReset'));

Route::get("/signup-login-redirect","Auth\AuthController@signupLoginRedirect");

Route::get('/restaurant/{restaurantId}',"RestaurantController@getDetail");

Route::post('/cartHandler',"CartController@handle");

Route::get('/getCartMobile',"CartController@getCartContentMobile");

Route::get('/getPnrDetail/{pnr_number}',"StationController@getPnrDetail");

Route::get('/restaurants/{station_code}/{slug}','RestaurantController@show');

Route::post("/processPayment","PaymentController@handle");

Route::get("/orderPlaced",array('as'   => 'order-placed','uses' =>"PaymentController@placed"));

Route::group(['middleware' => 'cart.auth'], function() { Route::post("/checkout",array('as' => 'checkout' ,'uses' => 'CartCheckout@handle')); });

Route::get('/forgotPassword','Auth\AuthController@forgotPassword');

Route::post('password/email','Auth\AuthController@sendPasswordResetToken');

Route::post('password/reset','Auth\AuthController@changePassword');
