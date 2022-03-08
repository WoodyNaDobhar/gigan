<?php

namespace App\Repositories;

use App\Models\Land;
use App\Repositories\BaseRepository;

/**
 * Class LandRepository
 * @package App\Repositories
 * @version March 7, 2022, 11:23 pm UTC
*/

class LandRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'kingdom_id',
        'label',
        'description',
        'image'
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
        return Land::class;
    }
}
