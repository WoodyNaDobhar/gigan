<?php

namespace App\DataTables;

use App\Models\Land;

/**
 * Class LandDataTable
 */
class LandDataTable
{
    /**
     * @return Land
     */
    public function get()
    {
        /** @var Land $query */
        $query = Land::query()->select('lands.*');

        return $query;
    }
}
