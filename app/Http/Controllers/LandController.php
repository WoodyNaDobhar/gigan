<?php

namespace App\Http\Controllers;

use App\DataTables\LandDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateLandRequest;
use App\Http\Requests\UpdateLandRequest;
use App\Repositories\LandRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class LandController extends AppBaseController
{
    /** @var  LandRepository */
    private $landRepository;

    public function __construct(LandRepository $landRepo)
    {
        $this->landRepository = $landRepo;
    }

    /**
     * Display a listing of the Land.
     *
     * @param LandDataTable $landDataTable
     * @return Response
     */
    public function index(LandDataTable $landDataTable)
    {
        return $landDataTable->render('lands.index');
    }

    /**
     * Show the form for creating a new Land.
     *
     * @return Response
     */
    public function create()
    {
        return view('lands.create');
    }

    /**
     * Store a newly created Land in storage.
     *
     * @param CreateLandRequest $request
     *
     * @return Response
     */
    public function store(CreateLandRequest $request)
    {
        $input = $request->all();

        $land = $this->landRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/lands.singular')]));

        return redirect(route('lands.index'));
    }

    /**
     * Display the specified Land.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $land = $this->landRepository->find($id);

        if (empty($land)) {
            Flash::error(__('messages.not_found', ['model' => __('models/lands.singular')]));

            return redirect(route('lands.index'));
        }

        return view('lands.show')->with('land', $land);
    }

    /**
     * Show the form for editing the specified Land.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $land = $this->landRepository->find($id);

        if (empty($land)) {
            Flash::error(__('messages.not_found', ['model' => __('models/lands.singular')]));

            return redirect(route('lands.index'));
        }

        return view('lands.edit')->with('land', $land);
    }

    /**
     * Update the specified Land in storage.
     *
     * @param  int              $id
     * @param UpdateLandRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLandRequest $request)
    {
        $land = $this->landRepository->find($id);

        if (empty($land)) {
            Flash::error(__('messages.not_found', ['model' => __('models/lands.singular')]));

            return redirect(route('lands.index'));
        }

        $land = $this->landRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/lands.singular')]));

        return redirect(route('lands.index'));
    }

    /**
     * Remove the specified Land from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $land = $this->landRepository->find($id);

        if (empty($land)) {
            Flash::error(__('messages.not_found', ['model' => __('models/lands.singular')]));

            return redirect(route('lands.index'));
        }

        $this->landRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/lands.singular')]));

        return redirect(route('lands.index'));
    }
}
