<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateIngredientAPIRequest;
use App\Http\Requests\API\UpdateIngredientAPIRequest;
use App\Models\Ingredient;
use App\Repositories\IngredientRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\IngredientResource;
use Response;

/**
 * Class IngredientController
 * @package App\Http\Controllers\API
 */

class IngredientAPIController extends AppBaseController
{
    /** @var  IngredientRepository */
    private $ingredientRepository;

    public function __construct(IngredientRepository $ingredientRepo)
    {
        $this->ingredientRepository = $ingredientRepo;
    }

    /**
     * Display a listing of the Ingredient.
     * GET|HEAD /ingredients
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $ingredients = $this->ingredientRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(IngredientResource::collection($ingredients), 'Ingredients retrieved successfully');
    }

    /**
     * Store a newly created Ingredient in storage.
     * POST /ingredients
     *
     * @param CreateIngredientAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateIngredientAPIRequest $request)
    {
        $input = $request->all();

        $ingredient = $this->ingredientRepository->create($input);

        return $this->sendResponse(new IngredientResource($ingredient), 'Ingredient saved successfully');
    }

    /**
     * Display the specified Ingredient.
     * GET|HEAD /ingredients/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Ingredient $ingredient */
        $ingredient = $this->ingredientRepository->find($id);

        if (empty($ingredient)) {
            return $this->sendError('Ingredient not found');
        }

        return $this->sendResponse(new IngredientResource($ingredient), 'Ingredient retrieved successfully');
    }

    /**
     * Update the specified Ingredient in storage.
     * PUT/PATCH /ingredients/{id}
     *
     * @param int $id
     * @param UpdateIngredientAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIngredientAPIRequest $request)
    {
        $input = $request->all();

        /** @var Ingredient $ingredient */
        $ingredient = $this->ingredientRepository->find($id);

        if (empty($ingredient)) {
            return $this->sendError('Ingredient not found');
        }

        $ingredient = $this->ingredientRepository->update($input, $id);

        return $this->sendResponse(new IngredientResource($ingredient), 'Ingredient updated successfully');
    }

    /**
     * Remove the specified Ingredient from storage.
     * DELETE /ingredients/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Ingredient $ingredient */
        $ingredient = $this->ingredientRepository->find($id);

        if (empty($ingredient)) {
            return $this->sendError('Ingredient not found');
        }

        $ingredient->delete();

        return $this->sendSuccess('Ingredient deleted successfully');
    }
}
