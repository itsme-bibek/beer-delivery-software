<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    /** @var string */
    public string $groupCode;

    /** @var string */
    public string $newStatus;

    /** @var \Illuminate\Support\Collection<int,Order> */
    public $orders;

    /** @var int */
    public int $totalItems;

    /** @var float|int */
    public $totalAmount;

    /**
     * @param string $groupCode
     * @param string $newStatus
     * @param \Illuminate\Support\Collection<int,Order> $orders
     */
    public function __construct(string $groupCode, string $newStatus, $orders)
    {
        $this->groupCode = $groupCode;
        $this->newStatus = $newStatus;
        $this->orders = $orders;
        $this->totalItems = (int) $orders->sum('quantity');
        $this->totalAmount = (float) $orders->sum('total_price');
    }

    public function build()
    {
        return $this
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Your order '.$this->groupCode.' is now '.$this->newStatus)
            ->view('emails.order-status-updated');
    }
}


