<?php

namespace App\Repositories;

use App\Models\Kingdom;
use App\Repositories\BaseRepository;

/**
 * Class KingdomRepository
 * @package App\Repositories
 * @version March 7, 2022, 11:22 pm UTC
*/

class KingdomRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return Kingdom::class;
    }
}
