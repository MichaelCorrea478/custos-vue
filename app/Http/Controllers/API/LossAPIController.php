<?php

namespace App\Http\Controllers\API;

use App\Events\Recipes\LossRegistered;
use App\Http\Requests\API\CreateLossAPIRequest;
use App\Http\Requests\API\UpdateLossAPIRequest;
use App\Models\Loss;
use App\Repositories\LossRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\LossResource;
use App\Models\Recipe;
use Response;

/**
 * Class LossController
 * @package App\Http\Controllers\API
 */

class LossAPIController extends AppBaseController
{
    /** @var  LossRepository */
    private $lossRepository;

    public function __construct(LossRepository $lossRepo)
    {
        $this->lossRepository = $lossRepo;
    }

    /**
     * Display a listing of the Loss.
     * GET|HEAD /losses
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $losses = $this->lossRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(LossResource::collection($losses), 'Losses retrieved successfully');
    }

    /**
     * Store a newly created Loss in storage.
     * POST /losses
     *
     * @param CreateLossAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateLossAPIRequest $request)
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

        $loss = $this->lossRepository->create($input);

        LossRegistered::dispatch($loss);

        return $this->sendResponse(new LossResource($loss), 'Perda registrada com sucesso');
    }

    /**
     * Display the specified Loss.
     * GET|HEAD /losses/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Loss $loss */
        $loss = $this->lossRepository->find($id);

        if (empty($loss)) {
            return $this->sendError('Loss not found');
        }

        return $this->sendResponse(new LossResource($loss), 'Loss retrieved successfully');
    }

    /**
     * Update the specified Loss in storage.
     * PUT/PATCH /losses/{id}
     *
     * @param int $id
     * @param UpdateLossAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLossAPIRequest $request)
    {
        $input = $request->all();

        /** @var Loss $loss */
        $loss = $this->lossRepository->find($id);

        if (empty($loss)) {
            return $this->sendError('Loss not found');
        }

        $loss = $this->lossRepository->update($input, $id);

        return $this->sendResponse(new LossResource($loss), 'Loss updated successfully');
    }

    /**
     * Remove the specified Loss from storage.
     * DELETE /losses/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Loss $loss */
        $loss = $this->lossRepository->find($id);

        if (empty($loss)) {
            return $this->sendError('Loss not found');
        }

        $loss->delete();

        return $this->sendSuccess('Loss deleted successfully');
    }
}
