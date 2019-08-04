<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmRequest extends Mailable
{
    use Queueable, SerializesModels;
    public $userdata, $leave, $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userdata, $leave, $comment)
    {
        //
        $this->userdata = $userdata;
        $this->leave = $leave;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         // return $this->from($this->userdata->email)->subject('LMSystem App: Leave Approval Confirmation')->view('email.confirm');
       return $this->from("test@test.com")->subject('LMSystem App: Leave Approval Confirmation')->view('email.confirm');
    }
}
