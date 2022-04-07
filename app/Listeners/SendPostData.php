<?php

namespace App\Listeners;

use App\Events\PostAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPostData
{
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
     * @param  \App\Events\PostAdded  $event
     * @return void
     */
    public function handle(PostAdded $event)
    {
        foreach ($event->emails as $email) {
            //send email
            Mail::to($email)->send(new \App\Mail\SendPostUpdateMail($event->post));
        }

    }
}
