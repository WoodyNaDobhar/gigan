<?php

namespace App\Repositories;

use App\Models\Week;
use App\Repositories\BaseRepository;

/**
 * Class WeekRepository
 * @package App\Repositories
 * @version March 7, 2022, 11:23 pm UTC
*/

class WeekRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'starts_at',
        'ends_at'
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
        return Week::class;
    }
}
