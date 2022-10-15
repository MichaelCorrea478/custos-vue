<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductionRequest;
use App\Http\Requests\UpdateProductionRequest;
use App\Repositories\ProductionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ProductionController extends AppBaseController
{
    /** @var ProductionRepository $productionRepository*/
    private $productionRepository;

    public function __construct(ProductionRepository $productionRepo)
    {
        $this->productionRepository = $productionRepo;
    }

    /**
     * Display a listing of the Production.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $productions = $this->productionRepository->all();

        return view('productions.index')
            ->with('productions', $productions);
    }

    /**
     * Show the form for creating a new Production.
     *
     * @return Response
     */
    public function create()
    {
        return view('productions.create');
    }

    /**
     * Store a newly created Production in storage.
     *
     * @param CreateProductionRequest $request
     *
     * @return Response
     */
    public function store(CreateProductionRequest $request)
    {
        $input = $request->all();

        $production = $this->productionRepository->create($input);

        Flash::success('Production saved successfully.');

        return redirect(route('productions.index'));
    }

    /**
     * Display the specified Production.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $production = $this->productionRepository->find($id);

        if (empty($production)) {
            Flash::error('Production not found');

            return redirect(route('productions.index'));
        }

        return view('productions.show')->with('production', $production);
    }

    /**
     * Show the form for editing the specified Production.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $production = $this->productionRepository->find($id);

        if (empty($production)) {
            Flash::error('Production not found');

            return redirect(route('productions.index'));
        }

        return view('productions.edit')->with('production', $production);
    }

    /**
     * Update the specified Production in storage.
     *
     * @param int $id
     * @param UpdateProductionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductionRequest $request)
    {
        $production = $this->productionRepository->find($id);

        if (empty($production)) {
            Flash::error('Production not found');

            return redirect(route('productions.index'));
        }

        $production = $this->productionRepository->update($request->all(), $id);

        Flash::success('Production updated successfully.');

        return redirect(route('productions.index'));
    }

    /**
     * Remove the specified Production from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $production = $this->productionRepository->find($id);

        if (empty($production)) {
            Flash::error('Production not found');

            return redirect(route('productions.index'));
        }

        $this->productionRepository->delete($id);

        Flash::success('Production deleted successfully.');

        return redirect(route('productions.index'));
    }
}
