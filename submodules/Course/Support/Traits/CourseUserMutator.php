<?php

namespace Course\Support\Traits;

trait CourseUserMutator
{
    public function getCurrentAttribute()
    {
        return $this->courses()->find($course_id)->current;
    }
}
