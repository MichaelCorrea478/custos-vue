<?php

namespace App\Events\Recipes;

use App\Models\Production;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductionRegistered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var Production  */
    public $production;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Production $production)
    {
        $this->production = $production;
    }
}
