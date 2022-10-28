<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\Recipes\IncomeRegistered;
use App\Events\Recipes\IngredientAdded;
use App\Events\Recipes\IngredientDeleted;
use App\Events\Recipes\LossRegistered;
use App\Events\Recipes\ProductionRegistered;
use App\Services\Recipes\RecipeService;

class RecipeEventSubscriber
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handleIncomeRegistered($event)
    {
        $this->recipeService->decreaseStock($event->income->recipe_id, $event->income->qty);
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handleLossRegistered($event)
    {
        $this->recipeService->decreaseStock($event->loss->recipe_id, $event->loss->qty);
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handleProductionRegistered($event)
    {
        $this->recipeService->updateAverageCost($event->production);
        $this->recipeService->increaseStock($event->production->recipe_id, $event->production->qty);
    }

    public function subscribe($events)
    {
        return [
            IncomeRegistered::class => 'handleIncomeRegistered',
            LossRegistered::class => 'handleLossRegistered',
            ProductionRegistered::class => 'handleProductionRegistered',
        ];
    }
}
