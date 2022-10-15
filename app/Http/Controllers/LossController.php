<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLossRequest;
use App\Http\Requests\UpdateLossRequest;
use App\Repositories\LossRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class LossController extends AppBaseController
{
    /** @var LossRepository $lossRepository*/
    private $lossRepository;

    public function __construct(LossRepository $lossRepo)
    {
        $this->lossRepository = $lossRepo;
    }

    /**
     * Display a listing of the Loss.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $losses = $this->lossRepository->all();

        return view('losses.index')
            ->with('losses', $losses);
    }

    /**
     * Show the form for creating a new Loss.
     *
     * @return Response
     */
    public function create()
    {
        return view('losses.create');
    }

    /**
     * Store a newly created Loss in storage.
     *
     * @param CreateLossRequest $request
     *
     * @return Response
     */
    public function store(CreateLossRequest $request)
    {
        $input = $request->all();

        $loss = $this->lossRepository->create($input);

        Flash::success('Loss saved successfully.');

        return redirect(route('losses.index'));
    }

    /**
     * Display the specified Loss.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $loss = $this->lossRepository->find($id);

        if (empty($loss)) {
            Flash::error('Loss not found');

            return redirect(route('losses.index'));
        }

        return view('losses.show')->with('loss', $loss);
    }

    /**
     * Show the form for editing the specified Loss.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $loss = $this->lossRepository->find($id);

        if (empty($loss)) {
            Flash::error('Loss not found');

            return redirect(route('losses.index'));
        }

        return view('losses.edit')->with('loss', $loss);
    }

    /**
     * Update the specified Loss in storage.
     *
     * @param int $id
     * @param UpdateLossRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLossRequest $request)
    {
        $loss = $this->lossRepository->find($id);

        if (empty($loss)) {
            Flash::error('Loss not found');

            return redirect(route('losses.index'));
        }

        $loss = $this->lossRepository->update($request->all(), $id);

        Flash::success('Loss updated successfully.');

        return redirect(route('losses.index'));
    }

    /**
     * Remove the specified Loss from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $loss = $this->lossRepository->find($id);

        if (empty($loss)) {
            Flash::error('Loss not found');

            return redirect(route('losses.index'));
        }

        $this->lossRepository->delete($id);

        Flash::success('Loss deleted successfully.');

        return redirect(route('losses.index'));
    }
}
