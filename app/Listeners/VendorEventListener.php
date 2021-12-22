<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class VendorEventListener
{ 
    
    public function onCreated($event){
        \Log::info('Vendor Added: '.$event->vendor->id);

        $event->vendor->notify(new VendorEvent($vendor));

        
    }
}
