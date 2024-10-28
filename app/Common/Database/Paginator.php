<?php

namespace App\Common\Database;


use Illuminate\Pagination\LengthAwarePaginator;

class Paginator extends LengthAwarePaginator
{

    public function transform(callable $callback)
    {
        parent::transform($callback);

        return $this;
    }

    public function map(callable $callback)
    {
        $this->items = $this->items->map($callback);

        return $this;
    }

    public function toArray()
    {
        return [
            'items' => $this->items->toArray(),
            'paginator' => [
                'current_page' => $this->currentPage(),
                'from' => $this->firstItem(),
                'last_page' => $this->lastPage(),
                'per_page' => $this->perPage(),
                'to' => $this->lastItem(),
                'total' => $this->total()
            ]
        ];
    }

}