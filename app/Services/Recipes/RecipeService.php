<?php

namespace App\Services\Recipes;

use App\Models\Production;
use App\Models\Recipe;

class RecipeService
{
    public function increaseStock(int $recipeId, int $qty)
    {
        $recipe = Recipe::find($recipeId);
        $recipe->stock_qty += $qty;
        $recipe->save();
    }

    public function decreaseStock(int $recipeId, int $qty)
    {
        $recipe = Recipe::find($recipeId);
        $recipe->stock_qty -= $qty;
        $recipe->save();
    }

    public function updateAverageCost(Production $production)
    {
        $recipe = $production->recipe;
        $recipe->avg_cost = ($recipe->getStockCost() + $production->getCost()) / ($recipe->stock_qty + $production->qty);
        $recipe->save();
    }
}
