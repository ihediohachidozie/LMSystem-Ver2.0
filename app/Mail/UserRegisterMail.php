<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisterMail extends Mailable
{
    use Queueable, SerializesModels;
    public $userdata;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userdata)
    {
        //
        $this->userdata = $userdata;
    }

    /**
     * Build the message.
     *   
     * @return $this
     */
    public function build()
    {
        return $this->from($this->userdata->email)->subject('LMSystem App: User Registration')->view('email.register');
        //return $this->from("test@test.com")->subject('LMSystem App: User Registration')->view('email.register');
        
    }
}
