<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateWeekAPIRequest;
use App\Http\Requests\API\UpdateWeekAPIRequest;
use App\Models\Week;
use App\Repositories\WeekRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\WeekResource;
use Response;

/**
 * Class WeekController
 * @package App\Http\Controllers\API
 */

class WeekAPIController extends AppBaseController
{
    /** @var  WeekRepository */
    private $weekRepository;

    public function __construct(WeekRepository $weekRepo)
    {
        $this->weekRepository = $weekRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/weeks",
     *      summary="Get a listing of the Weeks.",
     *      tags={"Week"},
     *      description="Get all Weeks",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Week")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $weeks = $this->weekRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            WeekResource::collection($weeks),
            __('messages.retrieved', ['model' => __('models/weeks.plural')])
        );
    }

    /**
     * @param CreateWeekAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/weeks",
     *      summary="Store a newly created Week in storage",
     *      tags={"Week"},
     *      description="Store Week",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Week that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Week")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Week"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateWeekAPIRequest $request)
    {
        $input = $request->all();

        $week = $this->weekRepository->create($input);

        return $this->sendResponse(
            new WeekResource($week),
            __('messages.saved', ['model' => __('models/weeks.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/weeks/{id}",
     *      summary="Display the specified Week",
     *      tags={"Week"},
     *      description="Get Week",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Week",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Week"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Week $week */
        $week = $this->weekRepository->find($id);

        if (empty($week)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/weeks.singular')])
            );
        }

        return $this->sendResponse(
            new WeekResource($week),
            __('messages.retrieved', ['model' => __('models/weeks.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateWeekAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/weeks/{id}",
     *      summary="Update the specified Week in storage",
     *      tags={"Week"},
     *      description="Update Week",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Week",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Week that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Week")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Week"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateWeekAPIRequest $request)
    {
        $input = $request->all();

        /** @var Week $week */
        $week = $this->weekRepository->find($id);

        if (empty($week)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/weeks.singular')])
            );
        }

        $week = $this->weekRepository->update($input, $id);

        return $this->sendResponse(
            new WeekResource($week),
            __('messages.updated', ['model' => __('models/weeks.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/weeks/{id}",
     *      summary="Remove the specified Week from storage",
     *      tags={"Week"},
     *      description="Delete Week",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Week",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Week $week */
        $week = $this->weekRepository->find($id);

        if (empty($week)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/weeks.singular')])
            );
        }

        $week->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/weeks.singular')])
        );
    }
}
