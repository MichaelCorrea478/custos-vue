<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Loss
 * @package App\Models
 * @version October 15, 2022, 2:45 am UTC
 *
 * @property integer $recipe_id
 * @property number $qty
 * @property number $cost
 */
class Loss extends Model
{

    use HasFactory;

    public $table = 'losses';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'recipe_id',
        'qty',
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
        'qty' => 'decimal:0',
        'cost' => 'decimal:0'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'recipe_id' => 'required|integer',
        'qty' => 'required|numeric',
        'cost' => 'required|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
