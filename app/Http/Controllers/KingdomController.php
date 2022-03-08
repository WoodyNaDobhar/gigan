<?php

namespace App\Http\Controllers;

use App\DataTables\KingdomDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateKingdomRequest;
use App\Http\Requests\UpdateKingdomRequest;
use App\Repositories\KingdomRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class KingdomController extends AppBaseController
{
    /** @var  KingdomRepository */
    private $kingdomRepository;

    public function __construct(KingdomRepository $kingdomRepo)
    {
        $this->kingdomRepository = $kingdomRepo;
    }

    /**
     * Display a listing of the Kingdom.
     *
     * @param KingdomDataTable $kingdomDataTable
     * @return Response
     */
    public function index(KingdomDataTable $kingdomDataTable)
    {
        return $kingdomDataTable->render('kingdoms.index');
    }

    /**
     * Show the form for creating a new Kingdom.
     *
     * @return Response
     */
    public function create()
    {
        return view('kingdoms.create');
    }

    /**
     * Store a newly created Kingdom in storage.
     *
     * @param CreateKingdomRequest $request
     *
     * @return Response
     */
    public function store(CreateKingdomRequest $request)
    {
        $input = $request->all();

        $kingdom = $this->kingdomRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/kingdoms.singular')]));

        return redirect(route('kingdoms.index'));
    }

    /**
     * Display the specified Kingdom.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $kingdom = $this->kingdomRepository->find($id);

        if (empty($kingdom)) {
            Flash::error(__('messages.not_found', ['model' => __('models/kingdoms.singular')]));

            return redirect(route('kingdoms.index'));
        }

        return view('kingdoms.show')->with('kingdom', $kingdom);
    }

    /**
     * Show the form for editing the specified Kingdom.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $kingdom = $this->kingdomRepository->find($id);

        if (empty($kingdom)) {
            Flash::error(__('messages.not_found', ['model' => __('models/kingdoms.singular')]));

            return redirect(route('kingdoms.index'));
        }

        return view('kingdoms.edit')->with('kingdom', $kingdom);
    }

    /**
     * Update the specified Kingdom in storage.
     *
     * @param  int              $id
     * @param UpdateKingdomRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKingdomRequest $request)
    {
        $kingdom = $this->kingdomRepository->find($id);

        if (empty($kingdom)) {
            Flash::error(__('messages.not_found', ['model' => __('models/kingdoms.singular')]));

            return redirect(route('kingdoms.index'));
        }

        $kingdom = $this->kingdomRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/kingdoms.singular')]));

        return redirect(route('kingdoms.index'));
    }

    /**
     * Remove the specified Kingdom from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $kingdom = $this->kingdomRepository->find($id);

        if (empty($kingdom)) {
            Flash::error(__('messages.not_found', ['model' => __('models/kingdoms.singular')]));

            return redirect(route('kingdoms.index'));
        }

        $this->kingdomRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/kingdoms.singular')]));

        return redirect(route('kingdoms.index'));
    }
}
