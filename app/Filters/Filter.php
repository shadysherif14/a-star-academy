<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filter
{

    protected $query;

    public function apply($query)
    {
        $this->query = $query;

        foreach (request()->only($this->filters) as $filter => $value) {

            if ($this->valid($filter)) {

                trim($value) ? $this->$filter($value) : $this->filter();
            
            }
        }

        return $query;
    }

    protected function valid($filter)
    {
        return in_array($filter, $this->filters) && method_exists($this, $filter) && request()->filled($filter);
    }
}

/** Make it an abstract to prevent initiating an object of it */
