<?php

namespace App\Mail;

use App\Writer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;
    public $writer;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Writer $writer)
    {
        $this->writer = $writer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('emails.emailVerification');
        return $this->markdown('emails.emailVerification');
    }
}
