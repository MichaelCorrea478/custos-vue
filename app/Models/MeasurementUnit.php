<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class MeasurementUnit
 * @package App\Models
 * @version October 15, 2022, 2:38 am UTC
 *
 * @property string $abbreviation
 * @property string $description
 */
class MeasurementUnit extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'measurement_units';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'abbreviation',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'abbreviation' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'abbreviation' => 'required|string',
        'description' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];


}
