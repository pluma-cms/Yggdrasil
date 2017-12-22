<?php

namespace Course\Observers;

use Course\Models\Course;

class CourseObserver
{
    /**
     * Listen to the Course created event.
     *
     * @param  \Course\Models\Course  $resource
     * @return void
     */
    public function created(Course $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Course successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the Course updated event.
     *
     * @param  \Course\Models\Course  $resource
     * @return void
     */
    public function updated(Course $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Course successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the Course deleted event.
     *
     * @param  \Course\Models\Course  $resource
     * @return void
     */
    public function deleted(Course $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Course successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the Course restored event.
     *
     * @param  \Course\Models\Course  $resource
     * @return void
     */
    public function restored(Course $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Course successfully restored");
        session()->flash('type', 'success');
    }
}
