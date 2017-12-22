<?php

namespace Content\Support\Traits;

use Content\Models\Content;

trait HasManyContents
{
    /**
     * Get the contents for the resource.
     *
     * @return  \Illuminate\Database\Eloquent\Model
     */
    public function contents()
    {
        return $this->hasMany(Content::class)->orderBy('sort', 'ASC');
    }
}
