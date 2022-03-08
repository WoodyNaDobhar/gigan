<?php

namespace App\Http\Controllers;

use App\DataTables\WeekDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateWeekRequest;
use App\Http\Requests\UpdateWeekRequest;
use App\Repositories\WeekRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class WeekController extends AppBaseController
{
    /** @var  WeekRepository */
    private $weekRepository;

    public function __construct(WeekRepository $weekRepo)
    {
        $this->weekRepository = $weekRepo;
    }

    /**
     * Display a listing of the Week.
     *
     * @param WeekDataTable $weekDataTable
     * @return Response
     */
    public function index(WeekDataTable $weekDataTable)
    {
        return $weekDataTable->render('weeks.index');
    }

    /**
     * Show the form for creating a new Week.
     *
     * @return Response
     */
    public function create()
    {
        return view('weeks.create');
    }

    /**
     * Store a newly created Week in storage.
     *
     * @param CreateWeekRequest $request
     *
     * @return Response
     */
    public function store(CreateWeekRequest $request)
    {
        $input = $request->all();

        $week = $this->weekRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/weeks.singular')]));

        return redirect(route('weeks.index'));
    }

    /**
     * Display the specified Week.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $week = $this->weekRepository->find($id);

        if (empty($week)) {
            Flash::error(__('messages.not_found', ['model' => __('models/weeks.singular')]));

            return redirect(route('weeks.index'));
        }

        return view('weeks.show')->with('week', $week);
    }

    /**
     * Show the form for editing the specified Week.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $week = $this->weekRepository->find($id);

        if (empty($week)) {
            Flash::error(__('messages.not_found', ['model' => __('models/weeks.singular')]));

            return redirect(route('weeks.index'));
        }

        return view('weeks.edit')->with('week', $week);
    }

    /**
     * Update the specified Week in storage.
     *
     * @param  int              $id
     * @param UpdateWeekRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWeekRequest $request)
    {
        $week = $this->weekRepository->find($id);

        if (empty($week)) {
            Flash::error(__('messages.not_found', ['model' => __('models/weeks.singular')]));

            return redirect(route('weeks.index'));
        }

        $week = $this->weekRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/weeks.singular')]));

        return redirect(route('weeks.index'));
    }

    /**
     * Remove the specified Week from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $week = $this->weekRepository->find($id);

        if (empty($week)) {
            Flash::error(__('messages.not_found', ['model' => __('models/weeks.singular')]));

            return redirect(route('weeks.index'));
        }

        $this->weekRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/weeks.singular')]));

        return redirect(route('weeks.index'));
    }
}
