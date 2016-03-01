<?php namespace App\Auth;

use Illuminate\Contracts\Auth\User as UserContract;
use Illuminate\Contracts\Auth\UserProvider as UserProviderInterface;
use Illuminate\Auth\GenericUser;
use App\Libraries\Curl;
use App\Config\Constants;
use Auth;
use App\Events\NewUserSignedUp;
use Input;
use Session;
use Event;

/*
* Custom User authentication class which authenticate and authorize user with communicating api at the backend
*/

class CustomUserProvider implements UserProviderInterface {


    private $curl;

    /**
    * The user object.
    */
    private $user;


    /**
    * Constructor
    *
    * @return void
    */
    public function __construct()
    {
        $this->curl = new Curl;
        if (!empty(Session::get('user'))) {
           $this->user = unserialize(Session::get('user'));
         } else {
             $this->user = null;
         }
    }

    /**
    * Retrieves a user by id
    *
    * @param int $identifier
    * @return mixed null|array
    */
    public function retrieveByID($identifier)
    {
        if(!is_null($this->user))
            return $this->user;

        $url       = API_HOST.USER_DETAIL_ROUTE.$identifier;
        $this->curl->setOption(CURLOPT_HEADER, true);
        $this->curl->setOption(CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = $this->curl->get($url); 
        $response = json_decode($response,true);
        if($response == null || isset($response['responseStatus']) && $response['responseStatus'] === false){
            return null;
        }  
        $userArray = array("id" => $response['emailId'],"name" => $response['name'],"contactNo" =>  $response['contactNo']);
        $userObject      = new GenericUser($userArray);
        if (is_null($this->user)) {
             Session::set('user', serialize($userObject));
          }  
        return $userObject;
    }
    

    /**
    * Tries to find a user based on the credentials passed.
    *
    * @param array $crendtials username|password
    * @return mixed bool|UserInterface
    */
    public function retrieveByCredentials(array $credentials)
    {
        $postParam = array("emailId" =>$credentials['email'],"loginPass" => $credentials['password']);
        $url       = API_HOST.LOGIN_API_ROUTE;
        $this->curl->setOption(CURLOPT_HEADER, true);
        $this->curl->setOption(CURLOPT_HTTPHEADER, array('Content-Type: application/json',"Accept: application/json"));
        $response = $this->curl->post($url, json_encode($postParam));
        $response = json_decode($response,true);
        if(isset($response['responseStatus']) && $response['responseStatus'] === true){
             $userArray = array("id" => $response['emailId'],"name" => $response['name']);
             return new GenericUser($userArray);
        } 

        return null;
 
    }


    /**
    * Validates the credentials passed to the ones in webservice.
    *
    * @param UserInterface $user
    * @param array $credentials
    * @return bool
    */
    public function validateCredentials(\Illuminate\Contracts\Auth\Authenticatable $user, array $credentials)
    {
        $postParam = array("emailId" =>$credentials['email'],"loginPass" => $credentials['password']);
        $url       = API_HOST.LOGIN_API_ROUTE;
        $this->curl->setOption(CURLOPT_HEADER, true);
        $this->curl->setOption(CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = $this->curl->post($url, json_encode($postParam));
        $response = json_decode($response,true);
        if($response == null || isset($response['responseStatus']) && $response['responseStatus'] === true)
            return true;

        return false;
    }


   /* Needed by Laravel 4.1.26 and above
   */
  public function retrieveByToken($identifier,$token)
  {
        $url       = API_HOST.TOKEN_ROUTE;
        $this->curl->setOption(CURLOPT_HEADER, true);
        $this->curl->setOption(CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = $this->curl->get($url,array("token" => $token));  
        $response = json_decode($response,true); 
        if($response == null || isset($response['responseStatus']) && $response['responseStatus'] === false)
            return null;
        $userArray = array("id" => $response['emailId'],"name" => $response['name']);
        return new GenericUser($userArray);
  }

  /**
   * Needed by Laravel 4.1.26 and above
   */
  public function updateRememberToken(\Illuminate\Contracts\Auth\Authenticatable $user, $token)
  {
        $url       = API_HOST."/customers/".$user->id."/update_remember_token/";
        $this->curl->setOption(CURLOPT_HEADER, true);
        $this->curl->setOption(CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = $this->curl->put($url,json_encode(array("rememberToken" => $token))); 
  }

    /**
    * Verifiy user account based on the code passed.
    *
    * @param verfication_token
    * @return bool
    */

   public function verifyUserAccount($code){
        $url       = API_HOST.VERIFIY_ACCOUNT_ROUTE;
        $this->curl->setOption(CURLOPT_HEADER, true);
        $this->curl->setOption(CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = $this->curl->put($url,json_encode(array("verificationToken" => $code))); 
        $response = json_decode($response,true);
        if($response != null && isset($response['responseStatus']) && $response['responseStatus'] === true && isset($response['verified']) && $response['verified'] === true){
            if(!empty($response['emailId']) && !empty($response['name'])){
                    $userData = array("emailId" =>$response['emailId'] ,"name" => $response['name']);
                    $userArray = new GenericUser(array("id" => $response['emailId'],"name" => $response['name']));
                    Auth::login($userArray);
                    Event::fire(new NewUserSignedUp($userData['emailId'], $userData['name']));
                    return true;
         }  
        return false;
    }
  }

/**
    * Update password reset token
    *
    * @param $emailid
    * @param $resetToken 
    * @return bool
    */

   public function updatePasswordResetToken($emailId,$resetToken){
        $url       = API_HOST.UPDATE_PASSWORD_RESET_TOKEN_ROUTE.$emailId."/update_password_reset_token";
        $this->curl->setOption(CURLOPT_HEADER, true);
        $this->curl->setOption(CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = $this->curl->put($url,json_encode(array("passResetToken" => $resetToken))); 
        $response = json_decode($response,true);
        if($response != null && isset($response['responseStatus']) && $response['responseStatus'] === true ){
                    return true;
         }  
        return false;
    }
  
      /**
    * Change password based on the code passed.
    *
    * @param $code reset token
    * @param $password 
    * @return bool
    */

   public function changePassword($code,$password){
        $url       = API_HOST.CHANGE_PASSWORD_ROUTE.$code."/reset_password";
        $this->curl->setOption(CURLOPT_HEADER, true);
        $this->curl->setOption(CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = $this->curl->put($url,json_encode(array("loginPass" => $password))); 
        $response = json_decode($response,true);
        if($response != null && isset($response['responseStatus']) && $response['responseStatus'] === true){
              return true;
         }  
        return false;
    }
}