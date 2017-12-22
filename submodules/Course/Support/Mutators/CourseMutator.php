<?php

namespace Course\Support\Mutators;

use Course\Models\Course;
use Course\Models\User;

trait CourseMutator
{
    /**
     * Alias for BelongsToUser.
     *
     * @return \User\Models\User
     */
    public function getAuthorAttribute()
    {
        return $this->user;
    }

    /**
     * Get the lesson count
     *
     * @return string
     */
    public function getLessonsCountAttribute()
    {
        return $this->lessons->count() . ' ' .
            ($this->lessons->count() > 1 ? __('Lessons') : __('Lesson'));
    }
}
