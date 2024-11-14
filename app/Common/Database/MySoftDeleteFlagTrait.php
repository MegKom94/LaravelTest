<?php

namespace App\Common\Database;


use Illuminate\Http\Request;
use Tsyama\LaravelSoftDeleteFlag\Traits\SoftDeleteFlagTrait;

trait MySoftDeleteFlagTrait
{
    use SoftDeleteFlagTrait;

    /**
     * Determine if the model instance has been soft-deleted.
     *
     * @return bool
     */
    public function trashed()
    {
        return (bool) $this->{$this->getDeletedAtColumn()};
    }

}