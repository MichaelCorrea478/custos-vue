<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IngredientResource extends JsonResource
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
            'qty' => $this->qty,
            'measurement_unit_id' => $this->measurement_unit_id,
            'price' => $this->price,
            'qty_in_recipe' => $this->whenPivotLoaded('ingredient_recipe', function() {
                                                        return $this->pivot->qty_in_recipe;
                                                    }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
