<?php

namespace Course\Support\Traits;

use Course\Models\User;

trait BelongsToManyUsers
{
    /**
     * Gets all User resources associated
     * with this model.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('current', 'next', 'previous');
    }
}
