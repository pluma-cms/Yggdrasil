<?php

namespace Lesson\Support\Traits;

use Lesson\Models\Lesson;

trait BelongsToLesson
{
    /**
     * Get the lesson that owns the resource.
     *
     * @return  \Illuminate\Database\Eloquent\Model
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
