<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Ticket_event implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $itSupport_id;
    public $name;
    /**
     * Create a new event instance.
     */
    public function __construct($itSupport_id,$name)
    {
        $this->itSupport_id = $itSupport_id;
        $this->name = $name;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // return new Channel("ticket_channel");
        return [new Channel("ticket_channel")]; // Wrap in array
        

        // return [
        //     new PrivateChannel('channel-name'),
        // ];
    }


    public function broadcastAs(){

        return "Ticket_event";
    }
}
