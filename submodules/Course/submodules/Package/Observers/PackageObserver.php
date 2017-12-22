<?php

namespace Package\Observers;

use Package\Models\Package;

class PackageObserver
{
    /**
     * Listen to the PackageObserver created event.
     *
     * @param  \Package\Models\Package  $resource
     * @return void
     */
    public function created(Package $resource)
    {
        // save fields
        session()->flash('title', $resource->name);
        session()->flash('message', "Package successfully created");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the PackageObserver updated event.
     *
     * @param  \Package\Models\Package  $resource
     * @return void
     */
    public function updated(Package $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Package successfully updated");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the PackageObserver deleted event.
     *
     * @param  \Package\Models\Package  $resource
     * @return void
     */
    public function deleted(Package $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Package successfully removed");
        session()->flash('type', 'success');
    }

    /**
     * Listen to the PackageObserver restored event.
     *
     * @param  \Package\Models\Package  $resource
     * @return void
     */
    public function restored(Package $resource)
    {
        session()->flash('title', $resource->name);
        session()->flash('message', "Package successfully restored");
        session()->flash('type', 'success');
    }
}
