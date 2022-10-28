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
        'description' => 'string|max:255',
        'price' => 'required|numeric'
    ];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class)->withPivot('qty_in_recipe');
    }

    public function getCost()
    {
        return $this->ingredients->reduce(function($cost, $ingredient) {
            return $cost += $ingredient->getPricePerUnit() * $ingredient->pivot->qty_in_recipe;
        });
    }

    public function getStockCost()
    {
        return ($this->stock_qty * $this->avg_cost) ?? 0;
    }

}
