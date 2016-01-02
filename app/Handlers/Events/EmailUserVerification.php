<?php namespace App\Handlers\Events;

use App\Events\UserVerification;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Mail;
use URL;

class EmailUserVerification {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  UserVerification  $event
	 * @return void
	 */
	public function handle(UserVerification $event)
	{
		$userEmail		  =  $event->userEmail;
		$userName  		  =  $event->userName;
		$verificationToken = $event->verificationToken;
		$link 			  =  URL::route('activate-account',$verificationToken);
		if(getenv("SEND_EMAIL") == true ) {
		        Mail::send('emails.confirm-email', array('username'=>$userName,'link' => $link), function($message) use($userEmail,$userName){
		            $message->to($userEmail, $userName)->subject('Activate your account ');
		        });
      }
	}

}
