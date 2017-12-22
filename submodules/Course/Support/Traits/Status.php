<?php

namespace Course\Support\Traits;

use Course\Models\Status as Model;

trait Status
{
    /**
     * Belongs to a status.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function status()
    {
        return $this->hasOne(Model::class);
    }

    /**
     * Get the status of the course.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getStateAttribute()
    {
        $state = $this->status()->where('user_id', user()->id)
                                ->where('course_id', $this->course->id)
                                ->where('content_id', $this->id)->first();
        return $state ? $state->status : null;
    }

    /**
     * Completed state.
     *
     * @return boolean
     */
    public function getCompletedAttribute()
    {
        return $this->state === "completed";
    }

    /**
     * Incomplete state.
     *
     * @return boolean
     */
    public function getIncompleteAttribute()
    {
        return $this->state === "incomplete";
    }

    /**
     * Incomplete state.
     *
     * @return boolean
     */
    public function getCurrentAttribute()
    {
        return $this->state === "not attempted" || $this->state === "current";
    }

    /**
     * Null or non-existant status.
     *
     * @return boolean
     */
    public function getLockedAttribute()
    {
        return $this->state === null;
    }
}
