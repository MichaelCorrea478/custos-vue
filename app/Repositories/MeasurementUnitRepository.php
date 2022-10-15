<?php

namespace App\Repositories;

use App\Models\MeasurementUnit;
use App\Repositories\BaseRepository;

/**
 * Class MeasurementUnitRepository
 * @package App\Repositories
 * @version October 15, 2022, 2:38 am UTC
*/

class MeasurementUnitRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'abbreviation',
        'description'
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
        return MeasurementUnit::class;
    }
}
