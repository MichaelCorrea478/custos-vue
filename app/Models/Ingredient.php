<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Ingredient
 * @package App\Models
 * @version October 15, 2022, 2:42 am UTC
 *
 * @property integer $user_id
 * @property string $description
 * @property number $qty
 * @property integer $measurement_unit_id
 * @property number $price
 */
class Ingredient extends Model
{

    use HasFactory;

    public $table = 'ingredients';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'user_id',
        'description',
        'qty',
        'measurement_unit_id',
        'price'
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
        'qty' => 'decimal:2',
        'measurement_unit_id' => 'integer',
        'price' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'description' => 'required|string',
        'qty' => 'required|numeric',
        'measurement_unit_id' => 'required|integer',
        'price' => 'required|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function measurementUnit()
    {
        return $this->belongsTo(MeasurementUnit::class);
    }

    public function getPricePerUnit()
    {
        return round($this->price / $this->qty, 2);
    }

}
