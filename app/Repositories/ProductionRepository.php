<?php

namespace App\Repositories;

use App\Models\Production;
use App\Repositories\BaseRepository;

/**
 * Class ProductionRepository
 * @package App\Repositories
 * @version October 15, 2022, 2:46 am UTC
*/

class ProductionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'recipe_id',
        'qty',
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
        return Production::class;
    }
}
