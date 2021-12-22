<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AssetEventListener
{
    
    public function onCreated($event){
        \Log::info('Asset Added: '.$event->asset->id);

        $event->user->notify(new AssetAdded($asset));

        
    }
}
