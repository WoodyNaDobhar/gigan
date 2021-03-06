<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLandAPIRequest;
use App\Http\Requests\API\UpdateLandAPIRequest;
use App\Models\Land;
use App\Repositories\LandRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\LandResource;
use Response;

/**
 * Class LandController
 * @package App\Http\Controllers\API
 */

class LandAPIController extends AppBaseController
{
    /** @var  LandRepository */
    private $landRepository;

    public function __construct(LandRepository $landRepo)
    {
        $this->landRepository = $landRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/lands",
     *      summary="Get a listing of the Lands.",
     *      tags={"Land"},
     *      description="Get all Lands",
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
     *                  @SWG\Items(ref="#/definitions/Land")
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
        $lands = $this->landRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            LandResource::collection($lands),
            __('messages.retrieved', ['model' => __('models/lands.plural')])
        );
    }

    /**
     * @param CreateLandAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/lands",
     *      summary="Store a newly created Land in storage",
     *      tags={"Land"},
     *      description="Store Land",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Land that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Land")
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
     *                  ref="#/definitions/Land"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateLandAPIRequest $request)
    {
        $input = $request->all();

        $land = $this->landRepository->create($input);

        return $this->sendResponse(
            new LandResource($land),
            __('messages.saved', ['model' => __('models/lands.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/lands/{id}",
     *      summary="Display the specified Land",
     *      tags={"Land"},
     *      description="Get Land",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Land",
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
     *                  ref="#/definitions/Land"
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
        /** @var Land $land */
        $land = $this->landRepository->find($id);

        if (empty($land)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/lands.singular')])
            );
        }

        return $this->sendResponse(
            new LandResource($land),
            __('messages.retrieved', ['model' => __('models/lands.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateLandAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/lands/{id}",
     *      summary="Update the specified Land in storage",
     *      tags={"Land"},
     *      description="Update Land",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Land",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Land that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Land")
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
     *                  ref="#/definitions/Land"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateLandAPIRequest $request)
    {
        $input = $request->all();

        /** @var Land $land */
        $land = $this->landRepository->find($id);

        if (empty($land)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/lands.singular')])
            );
        }

        $land = $this->landRepository->update($input, $id);

        return $this->sendResponse(
            new LandResource($land),
            __('messages.updated', ['model' => __('models/lands.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/lands/{id}",
     *      summary="Remove the specified Land from storage",
     *      tags={"Land"},
     *      description="Delete Land",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Land",
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
        /** @var Land $land */
        $land = $this->landRepository->find($id);

        if (empty($land)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/lands.singular')])
            );
        }

        $land->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/lands.singular')])
        );
    }
}
