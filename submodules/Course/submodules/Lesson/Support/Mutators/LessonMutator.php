<?php

namespace Lesson\Support\Mutators;

trait LessonMutator
{
    /**
     * Get the contents count
     *
     * @return string
     */
    public function getContentsCountAttribute()
    {
        return $this->contents->count() . ' ' .
            ($this->contents->count() > 1 ? __('Contents') : __('Content'));
    }

    /**
     * Gets the progress of user in percentage.
     *
     * @return int
     */
    public function getProgressAttribute()
    {
        return (float) number_format((float)(($this->completed * 100) / $this->contents->count()), 2);
    }

    /**
     * Gets the progress of user in percentage.
     *
     * @return string
     */
    public function getCompletedAttribute()
    {
        $count = \Course\Models\Status::where('user_id', user()->id)
            ->where('course_id', $this->course->id)
            ->whereIn('content_id', $this->contents()->pluck('id')->toArray())
            ->where('status', 'completed')
            ->count();

        return $count;
    }

    /**
     * Gets the dialog model.
     *
     * @return boolean
     */
    public function getDialogAttribute()
    {
        return false;
    }
}
