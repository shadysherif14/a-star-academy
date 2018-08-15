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
            
            if($this->exists($filter)) {

                trim($value) ? $this->$filter($value) : $this->$filter();
            }
        }

        return $query;
    }

    public function exists($filter)
    {
        return in_array($filter, $this->filters) && method_exists($this, $filter);
    }
}

/** Make it an abstract to prevent initiating an object of it */