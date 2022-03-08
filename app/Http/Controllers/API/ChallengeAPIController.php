<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateChallengeAPIRequest;
use App\Http\Requests\API\UpdateChallengeAPIRequest;
use App\Models\Challenge;
use App\Repositories\ChallengeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ChallengeResource;
use Response;

/**
 * Class ChallengeController
 * @package App\Http\Controllers\API
 */

class ChallengeAPIController extends AppBaseController
{
    /** @var  ChallengeRepository */
    private $challengeRepository;

    public function __construct(ChallengeRepository $challengeRepo)
    {
        $this->challengeRepository = $challengeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/challenges",
     *      summary="Get a listing of the Challenges.",
     *      tags={"Challenge"},
     *      description="Get all Challenges",
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
     *                  @SWG\Items(ref="#/definitions/Challenge")
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
        $challenges = $this->challengeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            ChallengeResource::collection($challenges),
            __('messages.retrieved', ['model' => __('models/challenges.plural')])
        );
    }

    /**
     * @param CreateChallengeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/challenges",
     *      summary="Store a newly created Challenge in storage",
     *      tags={"Challenge"},
     *      description="Store Challenge",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Challenge that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Challenge")
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
     *                  ref="#/definitions/Challenge"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateChallengeAPIRequest $request)
    {
        $input = $request->all();

        $challenge = $this->challengeRepository->create($input);

        return $this->sendResponse(
            new ChallengeResource($challenge),
            __('messages.saved', ['model' => __('models/challenges.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/challenges/{id}",
     *      summary="Display the specified Challenge",
     *      tags={"Challenge"},
     *      description="Get Challenge",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Challenge",
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
     *                  ref="#/definitions/Challenge"
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
        /** @var Challenge $challenge */
        $challenge = $this->challengeRepository->find($id);

        if (empty($challenge)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/challenges.singular')])
            );
        }

        return $this->sendResponse(
            new ChallengeResource($challenge),
            __('messages.retrieved', ['model' => __('models/challenges.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdateChallengeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/challenges/{id}",
     *      summary="Update the specified Challenge in storage",
     *      tags={"Challenge"},
     *      description="Update Challenge",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Challenge",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Challenge that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Challenge")
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
     *                  ref="#/definitions/Challenge"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateChallengeAPIRequest $request)
    {
        $input = $request->all();

        /** @var Challenge $challenge */
        $challenge = $this->challengeRepository->find($id);

        if (empty($challenge)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/challenges.singular')])
            );
        }

        $challenge = $this->challengeRepository->update($input, $id);

        return $this->sendResponse(
            new ChallengeResource($challenge),
            __('messages.updated', ['model' => __('models/challenges.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/challenges/{id}",
     *      summary="Remove the specified Challenge from storage",
     *      tags={"Challenge"},
     *      description="Delete Challenge",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Challenge",
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
        /** @var Challenge $challenge */
        $challenge = $this->challengeRepository->find($id);

        if (empty($challenge)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/challenges.singular')])
            );
        }

        $challenge->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/challenges.singular')])
        );
    }
}
