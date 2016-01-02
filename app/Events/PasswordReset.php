<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class PasswordReset extends Event {

	use SerializesModels;
	public $emailId;
	public $resetToken;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($emailId,$resetToken)
	{
		$this->emailId    = $emailId;
		$this->resetToken = $resetToken;
	}

}
