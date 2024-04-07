<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderReadyNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $order;
    public $orderDetails;

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @return void
     */
    public function __construct(array $data)
    {
        $this->user = $data['user'];
        $this->order = $data['order'];
        $this->orderDetails = $data['orderDetails'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order Ready Notification')
            ->view('emails.order.order-ready-notification', ['order' => $this->order, 'user' => $this->user]);
    }
}
