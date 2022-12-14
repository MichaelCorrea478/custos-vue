<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductionResource extends JsonResource
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
            'recipe_id' => $this->recipe_id,
            'qty' => $this->qty,
            'cost' => $this->cost,
            'production_cost' => $this->getCost(),
            'created_at' => $this->created_at,
        ];
    }
}
