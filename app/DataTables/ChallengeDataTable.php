<?php

namespace App\DataTables;

use App\Models\Challenge;

/**
 * Class ChallengeDataTable
 */
class ChallengeDataTable
{
    /**
     * @return Challenge
     */
    public function get()
    {
        /** @var Challenge $query */
        $query = Challenge::query()->select('challenges.*');

        return $query;
    }
}
