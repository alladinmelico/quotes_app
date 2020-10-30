<?php

namespace App\Listeners;

use App\Events\QuoteCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUserNotification
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
     * @param  QuoteCreated  $event
     * @return void
     */
    public function handle(QuoteCreated $event)
    {
        $author = $event->author_name;
        $email = $event->author_email;

        \Mail::send('email.notification', ['name'=>$author], function ($message) use($email,$author) {
            $message->from('admin@test.com', 'Admin');
            $message->to($email, $author);
            $message->subject('Thank you!');
        });
    }
}
