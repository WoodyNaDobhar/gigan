<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFlexerAPIRequest;
use App\Http\Requests\API\UpdateFlexerAPIRequest;
use App\Models\Flexer;
use App\Repositories\FlexerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\FlexerResource;
use Response;

/**
 * Class FlexerController
 * @package App\Http\Controllers\API
 */

class FlexerAPIController extends AppBaseController
{
    /** @var  FlexerRepository */
    private $flexerRepository;

    public function __construct(FlexerRepository $flexerRepo)
    {
        $this->flexerRepository = $flexerRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/flexers",
     *      summary="Get a listing of the Flexers.",
     *      tags={"Flexer"},
     *      description="Get all Flexers",
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
     *                  @SWG\Items(ref="#/definitions/Flexer")
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
        $flexers = $this->flexerRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            FlexerResource::collection($flexers),
            __('messages.retrieved', ['model' => __('models/flexers.plural')])
        );
    }

    /**
     * @param CreateFlexerAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/flexers",
     *      summary="Store a newly created Flexer in storage",
     *      tags={"Flexer"},
     *      description="Store Flexer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Flexer that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Flexer")
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
     *                  ref="#/definitions/Flexer"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateFlexerAPIRequest $request)
    {
        $input = $request->all();

        $flexer = $this->flexerRepository->create($input);

        return $this->sendResponse(
            new FlexerResource($flexer),
            __('messages.saved', ['model' => __('models/flexers.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/flexers/{id}",
     *      summary="Display the specified Flexer",
     *      tags={"Flexer"},
     *      description="Get Flexer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Flexer",
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
     *                  ref="#/definitions/Flexer"
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
        /** @var Flexer $flexer */
        $flexer = $this->flexerRepository->find($id);

        if (empty($flexer)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/flexers.singular')])
            );
        }

        return $this->sendResponse(
            new FlexerResource($flexer),
            __('messages.retrieved', ['model' => __('models/flexers.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateFlexerAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/flexers/{id}",
     *      summary="Update the specified Flexer in storage",
     *      tags={"Flexer"},
     *      description="Update Flexer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Flexer",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Flexer that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Flexer")
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
     *                  ref="#/definitions/Flexer"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateFlexerAPIRequest $request)
    {
        $input = $request->all();

        /** @var Flexer $flexer */
        $flexer = $this->flexerRepository->find($id);

        if (empty($flexer)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/flexers.singular')])
            );
        }

        $flexer = $this->flexerRepository->update($input, $id);

        return $this->sendResponse(
            new FlexerResource($flexer),
            __('messages.updated', ['model' => __('models/flexers.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/flexers/{id}",
     *      summary="Remove the specified Flexer from storage",
     *      tags={"Flexer"},
     *      description="Delete Flexer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Flexer",
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
        /** @var Flexer $flexer */
        $flexer = $this->flexerRepository->find($id);

        if (empty($flexer)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/flexers.singular')])
            );
        }

        $flexer->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/flexers.singular')])
        );
    }
}
