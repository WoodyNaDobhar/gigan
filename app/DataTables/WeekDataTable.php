<?php

namespace App\DataTables;

use App\Models\Week;

/**
 * Class WeekDataTable
 */
class WeekDataTable
{
    /**
     * @return Week
     */
    public function get()
    {
        /** @var Week $query */
        $query = Week::query()->select('weeks.*');

        return $query;
    }
}
