<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIngredientRequest;
use App\Http\Requests\UpdateIngredientRequest;
use App\Repositories\IngredientRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class IngredientController extends AppBaseController
{
    /** @var IngredientRepository $ingredientRepository*/
    private $ingredientRepository;

    public function __construct(IngredientRepository $ingredientRepo)
    {
        $this->ingredientRepository = $ingredientRepo;
    }

    /**
     * Display a listing of the Ingredient.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $ingredients = $this->ingredientRepository->all();

        return view('ingredients.index')
            ->with('ingredients', $ingredients);
    }

    /**
     * Show the form for creating a new Ingredient.
     *
     * @return Response
     */
    public function create()
    {
        return view('ingredients.create');
    }

    /**
     * Store a newly created Ingredient in storage.
     *
     * @param CreateIngredientRequest $request
     *
     * @return Response
     */
    public function store(CreateIngredientRequest $request)
    {
        $input = $request->all();

        $ingredient = $this->ingredientRepository->create($input);

        Flash::success('Ingredient saved successfully.');

        return redirect(route('ingredients.index'));
    }

    /**
     * Display the specified Ingredient.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ingredient = $this->ingredientRepository->find($id);

        if (empty($ingredient)) {
            Flash::error('Ingredient not found');

            return redirect(route('ingredients.index'));
        }

        return view('ingredients.show')->with('ingredient', $ingredient);
    }

    /**
     * Show the form for editing the specified Ingredient.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ingredient = $this->ingredientRepository->find($id);

        if (empty($ingredient)) {
            Flash::error('Ingredient not found');

            return redirect(route('ingredients.index'));
        }

        return view('ingredients.edit')->with('ingredient', $ingredient);
    }

    /**
     * Update the specified Ingredient in storage.
     *
     * @param int $id
     * @param UpdateIngredientRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIngredientRequest $request)
    {
        $ingredient = $this->ingredientRepository->find($id);

        if (empty($ingredient)) {
            Flash::error('Ingredient not found');

            return redirect(route('ingredients.index'));
        }

        $ingredient = $this->ingredientRepository->update($request->all(), $id);

        Flash::success('Ingredient updated successfully.');

        return redirect(route('ingredients.index'));
    }

    /**
     * Remove the specified Ingredient from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ingredient = $this->ingredientRepository->find($id);

        if (empty($ingredient)) {
            Flash::error('Ingredient not found');

            return redirect(route('ingredients.index'));
        }

        $this->ingredientRepository->delete($id);

        Flash::success('Ingredient deleted successfully.');

        return redirect(route('ingredients.index'));
    }
}
