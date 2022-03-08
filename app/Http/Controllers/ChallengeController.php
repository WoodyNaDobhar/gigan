<?php

namespace App\Http\Controllers;

use App\DataTables\ChallengeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateChallengeRequest;
use App\Http\Requests\UpdateChallengeRequest;
use App\Repositories\ChallengeRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ChallengeController extends AppBaseController
{
    /** @var  ChallengeRepository */
    private $challengeRepository;

    public function __construct(ChallengeRepository $challengeRepo)
    {
        $this->challengeRepository = $challengeRepo;
    }

    /**
     * Display a listing of the Challenge.
     *
     * @param ChallengeDataTable $challengeDataTable
     * @return Response
     */
    public function index(ChallengeDataTable $challengeDataTable)
    {
        dd($challengeDataTable->get());
        return $challengeDataTable->render('challenges.index');
    }

    /**
     * Show the form for creating a new Challenge.
     *
     * @return Response
     */
    public function create()
    {
        return view('challenges.create');
    }

    /**
     * Store a newly created Challenge in storage.
     *
     * @param CreateChallengeRequest $request
     *
     * @return Response
     */
    public function store(CreateChallengeRequest $request)
    {
        $input = $request->all();

        $challenge = $this->challengeRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/challenges.singular')]));

        return redirect(route('challenges.index'));
    }

    /**
     * Display the specified Challenge.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $challenge = $this->challengeRepository->find($id);

        if (empty($challenge)) {
            Flash::error(__('messages.not_found', ['model' => __('models/challenges.singular')]));

            return redirect(route('challenges.index'));
        }

        return view('challenges.show')->with('challenge', $challenge);
    }

    /**
     * Show the form for editing the specified Challenge.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $challenge = $this->challengeRepository->find($id);

        if (empty($challenge)) {
            Flash::error(__('messages.not_found', ['model' => __('models/challenges.singular')]));

            return redirect(route('challenges.index'));
        }

        return view('challenges.edit')->with('challenge', $challenge);
    }

    /**
     * Update the specified Challenge in storage.
     *
     * @param  int              $id
     * @param UpdateChallengeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateChallengeRequest $request)
    {
        $challenge = $this->challengeRepository->find($id);

        if (empty($challenge)) {
            Flash::error(__('messages.not_found', ['model' => __('models/challenges.singular')]));

            return redirect(route('challenges.index'));
        }

        $challenge = $this->challengeRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/challenges.singular')]));

        return redirect(route('challenges.index'));
    }

    /**
     * Remove the specified Challenge from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $challenge = $this->challengeRepository->find($id);

        if (empty($challenge)) {
            Flash::error(__('messages.not_found', ['model' => __('models/challenges.singular')]));

            return redirect(route('challenges.index'));
        }

        $this->challengeRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/challenges.singular')]));

        return redirect(route('challenges.index'));
    }
}
