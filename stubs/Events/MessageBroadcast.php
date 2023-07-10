<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $id;
    public string $message;
    public string $time;

    /**
     * Create a new event instance.
     */
    public function __construct(string $message , int $id , string $time)
    {
        $this->id = $id;
        $this->message = $message;
        $this->time = $time;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        $channel = new PrivateChannel($this->id);
        return [
            $channel->name
        ];
    }
    public function broadcastAs(): string
    {
        return  'chat';
    }
}
