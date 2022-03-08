<?php

namespace App\Repositories;

use App\Models\Flexer;
use App\Repositories\BaseRepository;

/**
 * Class FlexerRepository
 * @package App\Repositories
 * @version March 7, 2022, 11:22 pm UTC
*/

class FlexerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'orkID',
        'rank'
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
        return Flexer::class;
    }
}
