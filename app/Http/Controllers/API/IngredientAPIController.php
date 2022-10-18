<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateIngredientAPIRequest;
use App\Http\Requests\API\UpdateIngredientAPIRequest;
use App\Models\Ingredient;
use App\Repositories\IngredientRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\IngredientResource;
use Illuminate\Support\Facades\Gate;
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
        $params = array_merge(
                                $request->except(['skip', 'limit']),
                                ['user_id' => auth('api')->id()]
                            );
        $ingredients = $this->ingredientRepository->all(
            $params,
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(IngredientResource::collection($ingredients), 'Ingredientes recuperados com sucesso');
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
        $input = $request->validated();

        $ingredient = $this->ingredientRepository->create($input + ['user_id' => auth('api')->id()]);

        return $this->sendResponse(new IngredientResource($ingredient), 'Ingrediente salvo com sucesso');
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

        Gate::authorize('view', $ingredient);

        return $this->sendResponse(new IngredientResource($ingredient), 'Ingrediente recuperado com sucesso');
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
        $input = $request->validated();

        /** @var Ingredient $ingredient */
        $ingredient = $this->ingredientRepository->find($id);

        if (empty($ingredient)) {
            return $this->sendError('Ingrediente não encontrado');
        }

        Gate::authorize('update', $ingredient);

        $ingredient = $this->ingredientRepository->update($input, $id);

        return $this->sendResponse(new IngredientResource($ingredient), 'Ingrediente atualizado com sucesso');
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
            return $this->sendError('Ingrediente não encontrado');
        }

        Gate::authorize('delete', $ingredient);

        $ingredient->delete();

        return $this->sendSuccess('Ingrediente deletado com sucesso');
    }
}
