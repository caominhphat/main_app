<?php

namespace App\Listeners;

use App\Events\ItemCreated;
use App\libs\Helper;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ClearCacheListData
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
     * @param  \App\Events\ItemCreated  $event
     * @return void
     */
    public function handle(ItemCreated $event)
    {
        Helper::clearCache($event->table->getTable());
    }
}
