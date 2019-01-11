<?php

namespace App\Listeners;

use App\Events\EmailRegistered;
use App\Mail\EmailVerification;
use App\Writer;
use Illuminate\Support\Facades\Mail;

class VerifyEmailAddress
{
    public $writer;
    /**
     * Create the event listener.
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
     * @param  EmailRegistered  $event
     * @return void
     */
    public function handle(EmailRegistered $event)
    {
        $writer = Writer::find($event->id);

        Mail::to($writer->email)->send(new EmailVerification($writer));
        // Mail::send('emails.emailVerification', $writer, function ($message) use ($writer) {
        //     $message->from('admin@test.com', 'admin');
        //     $message->to($writer['email']);
        //     $message->subject('Event Testing');
        // });
    }
}
