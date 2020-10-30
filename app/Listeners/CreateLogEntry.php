<?php

namespace App\Listeners;

use App\Events\QuoteCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\QuoteLog;

class CreateLogEntry
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
        $log_entry = new QuoteLog();
        $log_entry->author = $author;
        $log_entry->save();
    }
}
