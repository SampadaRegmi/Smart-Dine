<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCreatedNotification;
use App\Models\User;

class SendOrderCreatedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(OrderCreated $event)
    {
        $adminUsers = User::where('role', 'admin')->get();

        foreach ($adminUsers as $adminUser) {
            Mail::to($adminUser->email)->send(new OrderCreatedNotification($event->order));
        }
    }
}
