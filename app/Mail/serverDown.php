<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class serverDown extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $user;
    private $dbs;
    public function __construct($user,$dbs)
    {
        //
        $this->user = $user;
        $this->dbs = $dbs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.serverDown',[
            "user"=>$this->user,
            "servidor"=>$this->dbs
        ]);
    }
}
