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
        'price' => 'decimal:0',
        'stock_qty' => 'integer',
        'cost' => 'decimal:0',
        'avg_cost' => 'decimal:0'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|integer',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'stock_qty' => 'nullable|integer',
        'cost' => 'nullable|numeric',
        'avg_cost' => 'nullable|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
