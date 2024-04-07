<?php

namespace App\Listeners;

use App\Events\NewOrderPlaced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewOrderNotification;

class SendNewOrderNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(NewOrderPlaced $event)
    {
        $adminEmail = 'sampadaregmi90@gmail.com'; // Replace with admin's email address
        Mail::to($adminEmail)->send(new NewOrderNotification($event->order));
    }
}

