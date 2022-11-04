<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'price' => $this->price,
            'stock_qty' => $this->stock_qty,
            'cost' => $this->getCost(),
            'avg_cost' => $this->avg_cost,
            'profit_margin' => $this->getProfitMargin(),
            'ingredients' => (!empty($this->ingredients))
                                ? IngredientResource::collection($this->ingredients)
                                : []
        ];
    }
}
