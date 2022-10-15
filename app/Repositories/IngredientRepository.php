<?php

namespace App\Repositories;

use App\Models\Ingredient;
use App\Repositories\BaseRepository;

/**
 * Class IngredientRepository
 * @package App\Repositories
 * @version October 15, 2022, 2:42 am UTC
*/

class IngredientRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'description',
        'qty',
        'measurement_unit_id',
        'price'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Ingredient::class;
    }
}
