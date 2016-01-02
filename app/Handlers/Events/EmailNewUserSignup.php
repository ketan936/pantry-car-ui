<?php namespace App\Handlers\Events;

use App\Events\NewUserSignedUp;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Mail;
use URL;

class EmailNewUserSignup {

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
	 * @param  NewUserSignedUp  $event
	 * @return void
	 */
	public function handle(NewUserSignedUp $event)
	{
		$userEmail =  $event->userEmail;
		$userName  =  $event->userName;
		if(getenv("SEND_EMAIL") == true ) {
			        Mail::send('emails.welcome-email', array('username'=>$userName), function($message) use($userEmail,$userName){
                             $message->to($userEmail, $userName)->subject('Welcome to PantryCar ');
                 });
		}
	}

}
