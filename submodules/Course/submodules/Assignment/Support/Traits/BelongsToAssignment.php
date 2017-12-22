<?php

namespace Assignment\Support\Traits;

use Assignment\Models\Assignment;

trait BelongsToAssignment
{
    /**
     * Get the assignment that owns the resource.
     *
     * @return  \Illuminate\Database\Eloquent\Model
     */
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }
}
