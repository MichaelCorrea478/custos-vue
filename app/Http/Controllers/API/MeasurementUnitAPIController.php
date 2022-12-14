<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMeasurementUnitAPIRequest;
use App\Http\Requests\API\UpdateMeasurementUnitAPIRequest;
use App\Models\MeasurementUnit;
use App\Repositories\MeasurementUnitRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MeasurementUnitController
 * @package App\Http\Controllers\API
 */

class MeasurementUnitAPIController extends AppBaseController
{
    /** @var  MeasurementUnitRepository */
    private $measurementUnitRepository;

    public function __construct(MeasurementUnitRepository $measurementUnitRepo)
    {
        $this->measurementUnitRepository = $measurementUnitRepo;
    }

    /**
     * Display a listing of the MeasurementUnit.
     * GET|HEAD /measurementUnits
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $measurementUnits = $this->measurementUnitRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($measurementUnits->toArray(), 'Unidades de medida recuperadas com sucesso.');
    }

    /**
     * Store a newly created MeasurementUnit in storage.
     * POST /measurementUnits
     *
     * @param CreateMeasurementUnitAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMeasurementUnitAPIRequest $request)
    {
        $input = $request->validated();

        $measurementUnit = $this->measurementUnitRepository->create($input + ['user_id' => auth('api')->id()]);

        return $this->sendResponse($measurementUnit->toArray(), 'Unidade de medida criada com sucesso.');
    }

    /**
     * Display the specified MeasurementUnit.
     * GET|HEAD /measurementUnits/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var MeasurementUnit $measurementUnit */
        $measurementUnit = $this->measurementUnitRepository->find($id);

        if (empty($measurementUnit)) {
            return $this->sendError('Measurement Unit not found');
        }

        return $this->sendResponse($measurementUnit->toArray(), 'Measurement Unit retrieved successfully');
    }

    /**
     * Update the specified MeasurementUnit in storage.
     * PUT/PATCH /measurementUnits/{id}
     *
     * @param int $id
     * @param UpdateMeasurementUnitAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMeasurementUnitAPIRequest $request)
    {
        $input = $request->all();

        /** @var MeasurementUnit $measurementUnit */
        $measurementUnit = $this->measurementUnitRepository->find($id);

        if (empty($measurementUnit)) {
            return $this->sendError('Unidade de medida n??o encontrada');
        }

        $measurementUnit = $this->measurementUnitRepository->update($input, $id);

        return $this->sendResponse($measurementUnit->toArray(), 'Unidade de medida atualizada com sucesso');
    }

    /**
     * Remove the specified MeasurementUnit from storage.
     * DELETE /measurementUnits/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var MeasurementUnit $measurementUnit */
        $measurementUnit = $this->measurementUnitRepository->find($id);

        if (empty($measurementUnit)) {
            return $this->sendError('Measurement Unit not found');
        }

        $measurementUnit->delete();

        return $this->sendSuccess('Measurement Unit deleted successfully');
    }
}
