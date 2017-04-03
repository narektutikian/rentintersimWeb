<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class ReportEvent
{
    use InteractsWithSockets, SerializesModels;

    public $order;

    /**
     * Create a new event instance.
     *
     * @param  Order  $order
     *
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        Log::info('Report Event Triggered');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
//    public function broadcastOn()
//    {
//        Log::info('Report Event Returns chanel');
//        return new PrivateChannel('channel-name');
//    }
}
