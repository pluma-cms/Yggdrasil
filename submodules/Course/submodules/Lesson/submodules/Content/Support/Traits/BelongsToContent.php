<?php

namespace Content\Support\Traits;

use Content\Models\Content;

trait BelongsToContent
{
    /**
     * Get the content that owns the resource.
     *
     * @return  \Illuminate\Database\Eloquent\Model
     */
    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
