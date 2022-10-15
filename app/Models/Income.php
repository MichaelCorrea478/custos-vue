<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Income
 * @package App\Models
 * @version October 15, 2022, 2:45 am UTC
 *
 * @property integer $recipe_id
 * @property integer $customer_id
 * @property number $qty
 * @property number $price
 * @property number $cost
 */
class Income extends Model
{

    use HasFactory;

    public $table = 'incomes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'recipe_id',
        'customer_id',
        'qty',
        'price',
        'cost'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'recipe_id' => 'integer',
        'customer_id' => 'integer',
        'qty' => 'decimal:0',
        'price' => 'decimal:0',
        'cost' => 'decimal:0'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'recipe_id' => 'required|integer',
        'customer_id' => 'required|integer',
        'qty' => 'required|numeric',
        'price' => 'required|numeric',
        'cost' => 'required|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
