<?php

namespace App\Repositories;

use App\Models\Income;
use App\Repositories\BaseRepository;

/**
 * Class IncomeRepository
 * @package App\Repositories
 * @version October 15, 2022, 2:45 am UTC
*/

class IncomeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'recipe_id',
        'customer_id',
        'qty',
        'price',
        'cost'
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
        return Income::class;
    }
}
