<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Recipe
 * @package App\Models
 * @version October 15, 2022, 2:44 am UTC
 *
 * @property integer $user_id
 * @property string $description
 * @property number $price
 * @property integer $stock_qty
 * @property number $cost
 * @property number $avg_cost
 */
class Recipe extends Model
{

    use HasFactory;

    public $table = 'recipes';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'user_id',
        'description',
        'price',
        'stock_qty',
        'cost',
        'avg_cost'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'description' => 'string',
        'price' => 'decimal:2',
        'stock_qty' => 'integer',
        'cost' => 'decimal:2',
        'avg_cost' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'description' => 'required|string|max:255',
        'price' => 'required|numeric|min:0.01'
    ];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class)->withPivot('qty_in_recipe');
    }

    public function getCost() :float
    {
        $cost = $this->ingredients->reduce(function($cost, $ingredient) {
            return $cost += $ingredient->getPricePerUnit() * $ingredient->pivot->qty_in_recipe;
        }) ?? 0;
        return round($cost, 2);
    }

    public function getStockCost() :float
    {
        return ($this->stock_qty * $this->avg_cost) ?? 0;
    }

    public function getProfitMargin() :float
    {
        $cost = $this->getCost();
        return ($cost > 0)
            ? round(($this->price - $this->getCost()) / $this->getCost() * 100, 2)
            : 100;
    }

}
