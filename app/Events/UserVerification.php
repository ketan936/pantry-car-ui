<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class UserVerification extends Event {

	use SerializesModels;
	public $userEmail;
    public $userName;
    public $verificationToken;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($userEmail,$userName,$verificationToken)
	{
		$this->userName          = $userName;
		$this->userEmail         = $userEmail;
		$this->verificationToken = $verificationToken;
	}

}
