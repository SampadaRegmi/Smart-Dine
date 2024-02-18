<?php
// app/Listeners/RegisteredListener.php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class RegisteredListener
{
    public function handle(Registered $event): void
    {
        redirect('/home');
    }
}

