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
            'description' => $this->description,
            'qty' => $this->qty,
            'measurement_unit_id' => $this->measurement_unit_id,
            'measurement_unit' => $this->measurementUnit->description,
            'measurement_unit_abbreviation' => $this->measurementUnit->abbreviation,
            'price' => $this->price,
            'price_per_unit' => $this->getPricePerUnit(),
            'qty_in_recipe' => $this->whenPivotLoaded('ingredient_recipe', function() {
                                                        return $this->pivot->qty_in_recipe;
                                                    }),
            'cost_in_recipe' => $this->whenPivotLoaded('ingredient_recipe', function() {
                                                        return $this->pivot->qty_in_recipe * $this->getPricePerUnit();
                                                    })
        ];
    }
}
