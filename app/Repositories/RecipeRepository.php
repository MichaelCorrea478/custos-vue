<?php

namespace App\Repositories;

use App\Models\Recipe;
use App\Repositories\BaseRepository;

/**
 * Class RecipeRepository
 * @package App\Repositories
 * @version October 15, 2022, 2:44 am UTC
*/

class RecipeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'description',
        'price',
        'stock_qty',
        'cost',
        'avg_cost'
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
        return Recipe::class;
    }
}
