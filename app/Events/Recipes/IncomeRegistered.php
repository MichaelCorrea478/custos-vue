<?php

namespace App\Events\Recipes;

use App\Models\Income;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IncomeRegistered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var Income  */
    public $income;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Income $income)
    {
        $this->income = $income;
    }
}
