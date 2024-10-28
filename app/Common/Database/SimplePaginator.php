<?php

namespace App\Common\Database;

use \Illuminate\Pagination\Paginator;

class SimplePaginator extends Paginator
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
						'first_page_url' => request()->url() . "/?page=1",
						'from' => $this->firstItem(),
						'next_page_url' => $this->nextPageUrl(),
						'path' => request()->url(),
						'per_page' => $this->perPage(),
						'prev_page_url' => $this->previousPageUrl(),
						'to' => $this->lastItem(),
				]
			];
	}
}

