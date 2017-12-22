<?php

namespace Course\Support\Traits;

use Course\Models\Course;

trait BelongsToManyCourses
{
    /**
     * Get the courses that belongs to this resource.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function courses()
    {
        return $this->BelongsToMany(Course::class);
    }
}
