<?php

namespace App\Repositories;

use App\Models\Loss;
use App\Repositories\BaseRepository;

/**
 * Class LossRepository
 * @package App\Repositories
 * @version October 15, 2022, 2:45 am UTC
*/

class LossRepository extends BaseRepository
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
        return Loss::class;
    }
}
