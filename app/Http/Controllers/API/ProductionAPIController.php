<?php

namespace App\Http\Controllers\API;

use App\Events\Recipes\ProductionRegistered;
use App\Http\Requests\API\CreateProductionAPIRequest;
use App\Http\Requests\API\UpdateProductionAPIRequest;
use App\Models\Production;
use App\Repositories\ProductionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ProductionResource;
use App\Models\Recipe;
use Illuminate\Support\Facades\Gate;
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
        dd($request);
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
        $input = $request->validated();

        /** @var Recipe $recipe **/
        $recipe = Recipe::find($input['recipe_id']);

        if (empty($recipe)) {
            return $this->sendError('Receita não encontrada');
        }

        if (auth('api')->id() != $recipe->user_id) {
            return $this->sendError('Você não possui esta receita');
        }

        if (!isset($input['cost'])) $input['cost'] = $recipe->getCost();

        $production = $this->productionRepository->create($input);

        ProductionRegistered::dispatch($production);

        return $this->sendResponse(new ProductionResource($production), 'Produção registrada com sucesso');
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
