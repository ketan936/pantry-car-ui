<?php namespace App\Handlers\Events;

use App\Events\PasswordReset;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Mail;
use URL;

class EmailPasswordReset {

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
	 * @param  PasswordReset  $event
	 * @return void
	 */
	public function handle(PasswordReset $event)
	{
	   $link 			  =  URL::route('password-reset',$event->resetToken);
	   $emailId           = $event->emailId;
        if(getenv("SEND_EMAIL") == true ) {
		        Mail::send('emails.password', array('username'=>$emailId,'link' => $link), function($message) use($emailId){
		            $message->to($emailId, $emailId)->subject('Password Reset');
		        });
      }
	}

}
