<?php

namespace App\Http\Controllers\API;

use App\Events\Recipes\IncomeRegistered;
use App\Http\Requests\API\CreateIncomeAPIRequest;
use App\Http\Requests\API\UpdateIncomeAPIRequest;
use App\Models\Income;
use App\Repositories\IncomeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\IncomeResource;
use App\Models\Recipe;
use Response;

/**
 * Class IncomeController
 * @package App\Http\Controllers\API
 */

class IncomeAPIController extends AppBaseController
{
    /** @var  IncomeRepository */
    private $incomeRepository;

    public function __construct(IncomeRepository $incomeRepo)
    {
        $this->incomeRepository = $incomeRepo;
    }

    /**
     * Display a listing of the Income.
     * GET|HEAD /incomes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $incomes = $this->incomeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(IncomeResource::collection($incomes), 'Incomes retrieved successfully');
    }

    /**
     * Store a newly created Income in storage.
     * POST /incomes
     *
     * @param CreateIncomeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateIncomeAPIRequest $request)
    {
        $input = $request->validated();

        /** @var Recipe $recipe */
        $recipe = Recipe::find($input['recipe_id']);

        if (empty($recipe)) {
            return $this->sendError('Receita não encontrada');
        }

        if (auth('api')->id() != $recipe->user_id) {
            return $this->sendError('Você não possui esta receita', 401);
        }

        if ($recipe->stock_qty < $input['qty']) {
            return $this->sendError('Estoque insuficiente', 400);
        }

        if (!isset($input['cost'])) $input['cost'] = $recipe->avg_cost;
        if (!isset($input['price'])) $input['price'] = $recipe->price;

        $income = $this->incomeRepository->create($input);

        IncomeRegistered::dispatch($income);

        return $this->sendResponse(new IncomeResource($income), 'Venda registrada com sucesso');
    }

    /**
     * Display the specified Income.
     * GET|HEAD /incomes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Income $income */
        $income = $this->incomeRepository->find($id);

        if (empty($income)) {
            return $this->sendError('Income not found');
        }

        return $this->sendResponse(new IncomeResource($income), 'Income retrieved successfully');
    }

    /**
     * Update the specified Income in storage.
     * PUT/PATCH /incomes/{id}
     *
     * @param int $id
     * @param UpdateIncomeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIncomeAPIRequest $request)
    {
        $input = $request->all();

        /** @var Income $income */
        $income = $this->incomeRepository->find($id);

        if (empty($income)) {
            return $this->sendError('Income not found');
        }

        $income = $this->incomeRepository->update($input, $id);

        return $this->sendResponse(new IncomeResource($income), 'Income updated successfully');
    }

    /**
     * Remove the specified Income from storage.
     * DELETE /incomes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Income $income */
        $income = $this->incomeRepository->find($id);

        if (empty($income)) {
            return $this->sendError('Income not found');
        }

        $income->delete();

        return $this->sendSuccess('Income deleted successfully');
    }
}
