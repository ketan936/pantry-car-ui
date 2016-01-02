<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class NewUserSignedUp extends Event {

	use SerializesModels;
	public $userEmail ;
	public $userName ;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($userEmail,$userName)
	{
		$this->userName  = $userName;
		$this->userEmail = $userEmail;
	}

}
