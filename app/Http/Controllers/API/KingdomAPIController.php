<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateKingdomAPIRequest;
use App\Http\Requests\API\UpdateKingdomAPIRequest;
use App\Models\Kingdom;
use App\Repositories\KingdomRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\KingdomResource;
use Response;

/**
 * Class KingdomController
 * @package App\Http\Controllers\API
 */

class KingdomAPIController extends AppBaseController
{
    /** @var  KingdomRepository */
    private $kingdomRepository;

    public function __construct(KingdomRepository $kingdomRepo)
    {
        $this->kingdomRepository = $kingdomRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/kingdoms",
     *      summary="Get a listing of the Kingdoms.",
     *      tags={"Kingdom"},
     *      description="Get all Kingdoms",
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
     *                  @SWG\Items(ref="#/definitions/Kingdom")
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
        $kingdoms = $this->kingdomRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            KingdomResource::collection($kingdoms),
            __('messages.retrieved', ['model' => __('models/kingdoms.plural')])
        );
    }

    /**
     * @param CreateKingdomAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/kingdoms",
     *      summary="Store a newly created Kingdom in storage",
     *      tags={"Kingdom"},
     *      description="Store Kingdom",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Kingdom that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Kingdom")
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
     *                  ref="#/definitions/Kingdom"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateKingdomAPIRequest $request)
    {
        $input = $request->all();

        $kingdom = $this->kingdomRepository->create($input);

        return $this->sendResponse(
            new KingdomResource($kingdom),
            __('messages.saved', ['model' => __('models/kingdoms.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/kingdoms/{id}",
     *      summary="Display the specified Kingdom",
     *      tags={"Kingdom"},
     *      description="Get Kingdom",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Kingdom",
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
     *                  ref="#/definitions/Kingdom"
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
        /** @var Kingdom $kingdom */
        $kingdom = $this->kingdomRepository->find($id);

        if (empty($kingdom)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/kingdoms.singular')])
            );
        }

        return $this->sendResponse(
            new KingdomResource($kingdom),
            __('messages.retrieved', ['model' => __('models/kingdoms.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateKingdomAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/kingdoms/{id}",
     *      summary="Update the specified Kingdom in storage",
     *      tags={"Kingdom"},
     *      description="Update Kingdom",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Kingdom",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Kingdom that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Kingdom")
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
     *                  ref="#/definitions/Kingdom"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateKingdomAPIRequest $request)
    {
        $input = $request->all();

        /** @var Kingdom $kingdom */
        $kingdom = $this->kingdomRepository->find($id);

        if (empty($kingdom)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/kingdoms.singular')])
            );
        }

        $kingdom = $this->kingdomRepository->update($input, $id);

        return $this->sendResponse(
            new KingdomResource($kingdom),
            __('messages.updated', ['model' => __('models/kingdoms.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/kingdoms/{id}",
     *      summary="Remove the specified Kingdom from storage",
     *      tags={"Kingdom"},
     *      description="Delete Kingdom",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Kingdom",
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
        /** @var Kingdom $kingdom */
        $kingdom = $this->kingdomRepository->find($id);

        if (empty($kingdom)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/kingdoms.singular')])
            );
        }

        $kingdom->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/kingdoms.singular')])
        );
    }
}
