<?php

namespace App\DataTables;

use App\Models\Flexer;

/**
 * Class FlexerDataTable
 */
class FlexerDataTable
{
    /**
     * @return Flexer
     */
    public function get()
    {
        /** @var Flexer $query */
        $query = Flexer::query()->select('flexers.*');

        return $query;
    }
}
