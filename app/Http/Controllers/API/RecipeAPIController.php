<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRecipeAPIRequest;
use App\Http\Requests\API\UpdateRecipeAPIRequest;
use App\Models\Recipe;
use App\Repositories\RecipeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\RecipeResource;
use Illuminate\Support\Facades\Gate;
use Response;

/**
 * Class RecipeController
 * @package App\Http\Controllers\API
 */

class RecipeAPIController extends AppBaseController
{
    /** @var  RecipeRepository */
    private $recipeRepository;

    public function __construct(RecipeRepository $recipeRepo)
    {
        $this->recipeRepository = $recipeRepo;
    }

    /**
     * Display a listing of the Recipe.
     * GET|HEAD /recipes
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
        $recipes = $this->recipeRepository->all(
            $params,
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(RecipeResource::collection($recipes), 'Receitas recuperadas com sucesso');
    }

    /**
     * Store a newly created Recipe in storage.
     * POST /recipes
     *
     * @param CreateRecipeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRecipeAPIRequest $request)
    {
        $input = $request->validated();

        $recipe = $this->recipeRepository->create($input + ['user_id' => auth('api')->id()]);

        return $this->sendResponse(new RecipeResource($recipe), 'Receita salva com sucesso');
    }

    /**
     * Display the specified Recipe.
     * GET|HEAD /recipes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Recipe $recipe */
        $recipe = $this->recipeRepository->find($id);

        if (empty($recipe)) {
            return $this->sendError('Recipe not found');
        }

        Gate::authorize('view', $recipe);

        return $this->sendResponse(new RecipeResource($recipe), 'Recipe retrieved successfully');
    }

    /**
     * Update the specified Recipe in storage.
     * PUT/PATCH /recipes/{id}
     *
     * @param int $id
     * @param UpdateRecipeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRecipeAPIRequest $request)
    {
        $input = $request->validated();

        /** @var Recipe $recipe */
        $recipe = $this->recipeRepository->find($id);

        if (empty($recipe)) {
            return $this->sendError('Recipe not found');
        }

        Gate::authorize('update', $recipe);

        $recipe = $this->recipeRepository->update($input, $id);

        return $this->sendResponse(new RecipeResource($recipe), 'Receita atualizada com sucesso');
    }

    /**
     * Remove the specified Recipe from storage.
     * DELETE /recipes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Recipe $recipe */
        $recipe = $this->recipeRepository->find($id);

        if (empty($recipe)) {
            return $this->sendError('Receita não encontrada');
        }

        Gate::authorize('delete', $recipe);

        $recipe->delete();

        return $this->sendSuccess('Receita deletada com sucesso');
    }
}
