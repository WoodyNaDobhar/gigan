<?php

namespace App\DataTables;

use App\Models\Kingdom;

/**
 * Class KingdomDataTable
 */
class KingdomDataTable
{
    /**
     * @return Kingdom
     */
    public function get()
    {
        /** @var Kingdom $query */
        $query = Kingdom::query()->select('kingdoms.*');

        return $query;
    }
}
