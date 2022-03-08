<?php

namespace App\Repositories;

use App\Models\Challenge;
use App\Repositories\BaseRepository;

/**
 * Class ChallengeRepository
 * @package App\Repositories
 * @version March 8, 2022, 12:39 am UTC
*/

class ChallengeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'challenger_id',
        'challenged_id',
        'week_id',
        'winner_id',
        'challenged_at',
        'challenger_rank',
        'challenged_rank',
        'video'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Challenge::class;
    }
}
