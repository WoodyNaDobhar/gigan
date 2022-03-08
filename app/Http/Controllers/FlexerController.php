<?php

namespace App\Http\Controllers;

use App\DataTables\FlexerDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateFlexerRequest;
use App\Http\Requests\UpdateFlexerRequest;
use App\Repositories\FlexerRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class FlexerController extends AppBaseController
{
    /** @var  FlexerRepository */
    private $flexerRepository;

    public function __construct(FlexerRepository $flexerRepo)
    {
        $this->flexerRepository = $flexerRepo;
    }

    /**
     * Display a listing of the Flexer.
     *
     * @param FlexerDataTable $flexerDataTable
     * @return Response
     */
    public function index(FlexerDataTable $flexerDataTable)
    {
        return $flexerDataTable->render('flexers.index');
    }

    /**
     * Show the form for creating a new Flexer.
     *
     * @return Response
     */
    public function create()
    {
        return view('flexers.create');
    }

    /**
     * Store a newly created Flexer in storage.
     *
     * @param CreateFlexerRequest $request
     *
     * @return Response
     */
    public function store(CreateFlexerRequest $request)
    {
        $input = $request->all();

        $flexer = $this->flexerRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/flexers.singular')]));

        return redirect(route('flexers.index'));
    }

    /**
     * Display the specified Flexer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $flexer = $this->flexerRepository->find($id);

        if (empty($flexer)) {
            Flash::error(__('messages.not_found', ['model' => __('models/flexers.singular')]));

            return redirect(route('flexers.index'));
        }

        return view('flexers.show')->with('flexer', $flexer);
    }

    /**
     * Show the form for editing the specified Flexer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $flexer = $this->flexerRepository->find($id);

        if (empty($flexer)) {
            Flash::error(__('messages.not_found', ['model' => __('models/flexers.singular')]));

            return redirect(route('flexers.index'));
        }

        return view('flexers.edit')->with('flexer', $flexer);
    }

    /**
     * Update the specified Flexer in storage.
     *
     * @param  int              $id
     * @param UpdateFlexerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFlexerRequest $request)
    {
        $flexer = $this->flexerRepository->find($id);

        if (empty($flexer)) {
            Flash::error(__('messages.not_found', ['model' => __('models/flexers.singular')]));

            return redirect(route('flexers.index'));
        }

        $flexer = $this->flexerRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/flexers.singular')]));

        return redirect(route('flexers.index'));
    }

    /**
     * Remove the specified Flexer from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $flexer = $this->flexerRepository->find($id);

        if (empty($flexer)) {
            Flash::error(__('messages.not_found', ['model' => __('models/flexers.singular')]));

            return redirect(route('flexers.index'));
        }

        $this->flexerRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/flexers.singular')]));

        return redirect(route('flexers.index'));
    }
}
