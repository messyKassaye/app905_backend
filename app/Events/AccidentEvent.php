<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

use App\Fault;
class AccidentEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $accident;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Fault $accident)
    {
        //
        $this->accident = $accident;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['accident-on'];
    }


    public function broadcastAs()
    {
      return 'all-accidents';
    }

    public function broadcastWith(){
        return [
            'id'=>$this->accident->id,
            'sender_phone'=>$this->accident->sender_phone,
            'specific_name'=>$this->accident->specific_name,
            'accident_type_id'=>$this->accident->fault_type_id
        ];
    }
}
