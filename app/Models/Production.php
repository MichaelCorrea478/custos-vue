<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Production
 * @package App\Models
 * @version October 15, 2022, 2:46 am UTC
 *
 * @property integer $recipe_id
 * @property number $qty
 * @property number $cost
 */
class Production extends Model
{

    use HasFactory;

    public $table = 'productions';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'recipe_id',
        'qty',
        'cost',
        'created_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'recipe_id' => 'integer',
        'qty' => 'decimal:2',
        'cost' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'recipe_id' => 'required|integer',
        'qty' => 'required|numeric',
        'cost' => 'nullable|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function getCost()
    {
        return round($this->qty * $this->cost, 2);
    }
}
