<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Auth\CustomUserProvider;
use App\Http\Controllers\RegisterController;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Auth;
use Illuminate\Auth\GenericUser;
use App\Config\Constants;
use App\Events\PasswordReset;
use App\Events\UserVerification;
use Input;
use Redirect;
use Response;
use Event;
use Socialize;
use Validator;


class AuthController extends Controller {


  public function login() {

    $intendedURL =  Redirect::intended('/')->getTargetUrl();
    // Getting all post data
    $data = Input::all();
    // Applying validation rules.
    $rules = array(
		              'email'    => 'required|email',
		              'password' => 'required|min:6',
	         );
    $validator = Validator::make($data, $rules);
    if ($validator->fails()){
      
      return Response::json(array(
        'success' => false,
        'errors' => $validator->getMessageBag()->toArray()
        ), 200);
    }
    else {
         $userData = array(
		                        'email'    => Input::get('email'),
		                        'password' => Input::get('password')
		     );
      $rememberMe = empty(Input::get('remember'))?false:true;
      if (Auth::attempt($userData,$rememberMe)) {
        return Response::json(['success' => true,"next" => $intendedURL], 200);
       }

      else
         return Response::json(['fail' => true], 200);
      }
  }



  public function signup() {
    // Getting all post data
    $data = Input::all();
    // Applying validation rules.
    $rules = array(
            'email'         => 'required|email',
            'phone-number'  => 'required|min:10',
            'password'      => 'required|min:6|same:cpassword',
            'cpassword'     => 'required|min:6'
       );

    $validator = Validator::make($data, $rules);
    if ($validator->fails()){
      
      return Response::json(array(
        'success' => false,
        'errors' => $validator->getMessageBag()->toArray()
        ), 200);
    }
    else {
      $verificationToken =  str_random(60);
      $userData = array(
                          'emailId'   => Input::get('email'),
                          'loginPass' => Input::get('password'),
                          'contactNo' => Input::get('phone-number'),
                          'name'      => Input::get('name'),
                          'verificationToken' => $verificationToken
      );
     
       $registerController = new RegisterController;
       if ($registerController->store($userData)){
        Event::fire(new UserVerification($userData['emailId'], $userData['name'],$userData['verificationToken']));
        return Response::json(['success' => true], 200);
       }
      else
         return Response::json(['fail' => true], 200);

    }
  }



  public function facebook_redirect() {
    return Socialize::with('facebook')->redirect();
  }



  public function google_redirect() {
    return Socialize::with('google')->redirect();
  }

  
 
  public function facebook() {

    $error = Input::get("error");
    if(empty($error)){
         $user   = Socialize::with('facebook')->user();
         list($responseStatus,$errorIfAny) = $this->createOrloginUser($user,"facebook");

         if($responseStatus == true )
            return self::handleSocialPostRedirect();
         else
            return redirect('/')->with("error_message",$errorIfAny);
             
    }
    else if($error == ACCESS_DENIED){
      return redirect('/')->with("error_message","You denied permission !");
    }
    else{
      return redirect('/')->with("error_message","Error while logging through facebook");
    }
    
  }

  
  public function google() {

    $error = Input::get("error");
    if(empty($error)){
         $user   = Socialize::with('google')->user();
         list($responseStatus,$errorIfAny) = $this->createOrloginUser($user,"google");
         if($responseStatus == true )
            return self::handleSocialPostRedirect();
         else
            return redirect('/')->with("error_message",$errorIfAny);   
    }
    else if($error == ACCESS_DENIED){
      return redirect('/')->with("error_message","You denied permission !");
    }
    else{
      return redirect('/')->with("error_message","Error while logging through facebook");
    }
  }

  public function createOrloginUser($user,$provider){
        
        $email = $user->getEmail();
        $name  = $user->getName();
        if(empty($email))
        {
             return array(false ,"No email id found with your $provider account .");
        }
        else{
            $userProvider = new CustomUserProvider();
            $user = $userProvider->retrieveByID($email);
            if(empty($user)){
               $userdata = array("emailId" => $email,"name" => $name);
               $registerController = new RegisterController;
               $verificationToken =  str_random(60);
               $userData = array(
                          'emailId'   => $email,
                          'name'      => $name,
                          'verificationToken' => $verificationToken
                           );
               if ($registerController->store($userdata)){
                  //Mailer::sendEmailVerificationMail($userData);
                  return array(true,"");
               }
               else{
                   return array(false ,"Error while signup with you $provider account .Please try again .");
               }
            }
            else{
                  Auth::login($user);
                  return array(true,"");
            }
            
        }
  }

  public function activateAccount($code){
      
      $userProvider = new CustomUserProvider();
      if(!empty($code)){
        if($userProvider->verifyUserAccount($code)){
            return redirect('/')->with("success_message","Account Verified .You can now order your meal right away");
        }
        else{
           return redirect('/')->with("error_message","Error while verifying your account");
        }
      }
      else{
        return redirect('/')->with("error_message","Link invalid");
      }
      
  }

  public function handleSocialPostRedirect(){
       return redirect("/signup-login-redirect");
  }

  public function signupLoginRedirect(){
      return view("signup-login-redirect");
    }

   public function forgotPassword(){
      return view('auth/password');
   } 

   public function sendPasswordResetToken(){

      $emailId = Input::get('email');
     if(!empty($emailId)){
         $resetToken   = str_random(60);
         $userProvider = new CustomUserProvider();
         if($userProvider->updatePasswordResetToken($emailId,$resetToken)){
                     Event::fire(new PasswordReset($emailId, $resetToken));
                     return redirect('/forgotPassword')->with('status',"A password reset link has been sent to ".$emailId." .Please check ");
         }
         else{
                 return redirect('/forgotPassword')->with('errors',"Something went wrong .Please try again .");
         }

     }
     else{
         $errors = array("Email id was empty.");
         return redirect('/forgotPassword')->with('errors',$errors);
     }
   }
   public function passwordReset($resetToken){
      if(!empty($resetToken)){
          return view('auth.password-reset')->with('code',$resetToken);
      }
      else{
          return redirect('/')->with('error_message','Link invalid');
      }
   }
  public function changePassword(){

    $data = Input::all();
    // Applying validation rules.
    $rules = array(
            'password'      => 'required|min:6|same:cpassword',
            'cpassword'     => 'required|min:6'
       );
     $code     = Input::get('code');
     $password = Input::get('password');

     if(empty($code)){
        return redirect('/')->with("error_message","Something went wrong .Try again.");
     }

    $validator = Validator::make($data, $rules);
    if ($validator->fails()){
       return redirect('/passwordReset/'.$code)->withErrors($validator->getMessageBag()->toArray());
    }
    else{
         $userProvider = new CustomUserProvider();
         if($userProvider->changePassword($code,$password)){
            return redirect('/')->with('success_message','Your new password has been updated .You can now login with new password .');
         }
         else{
             return redirect('/passwordReset/'.$code)->withErrors(array("Something went wrong .Please try again."));  
         }
    }
  }

}