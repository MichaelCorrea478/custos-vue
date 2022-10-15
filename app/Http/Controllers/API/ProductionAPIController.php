<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductionAPIRequest;
use App\Http\Requests\API\UpdateProductionAPIRequest;
use App\Models\Production;
use App\Repositories\ProductionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ProductionResource;
use Response;

/**
 * Class ProductionController
 * @package App\Http\Controllers\API
 */

class ProductionAPIController extends AppBaseController
{
    /** @var  ProductionRepository */
    private $productionRepository;

    public function __construct(ProductionRepository $productionRepo)
    {
        $this->productionRepository = $productionRepo;
    }

    /**
     * Display a listing of the Production.
     * GET|HEAD /productions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $productions = $this->productionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ProductionResource::collection($productions), 'Productions retrieved successfully');
    }

    /**
     * Store a newly created Production in storage.
     * POST /productions
     *
     * @param CreateProductionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProductionAPIRequest $request)
    {
        $input = $request->all();

        $production = $this->productionRepository->create($input);

        return $this->sendResponse(new ProductionResource($production), 'Production saved successfully');
    }

    /**
     * Display the specified Production.
     * GET|HEAD /productions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Production $production */
        $production = $this->productionRepository->find($id);

        if (empty($production)) {
            return $this->sendError('Production not found');
        }

        return $this->sendResponse(new ProductionResource($production), 'Production retrieved successfully');
    }

    /**
     * Update the specified Production in storage.
     * PUT/PATCH /productions/{id}
     *
     * @param int $id
     * @param UpdateProductionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Production $production */
        $production = $this->productionRepository->find($id);

        if (empty($production)) {
            return $this->sendError('Production not found');
        }

        $production = $this->productionRepository->update($input, $id);

        return $this->sendResponse(new ProductionResource($production), 'Production updated successfully');
    }

    /**
     * Remove the specified Production from storage.
     * DELETE /productions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Production $production */
        $production = $this->productionRepository->find($id);

        if (empty($production)) {
            return $this->sendError('Production not found');
        }

        $production->delete();

        return $this->sendSuccess('Production deleted successfully');
    }
}
