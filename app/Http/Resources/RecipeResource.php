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
            'user_id' => $this->user_id,
            'description' => $this->description,
            'price' => $this->price,
            'stock_qty' => $this->stock_qty,
            'cost' => $this->cost,
            'avg_cost' => $this->avg_cost,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'ingredients' => (!empty($this->ingredients))
                                ? IngredientResource::collection($this->ingredients)
                                : []
        ];
    }
}
