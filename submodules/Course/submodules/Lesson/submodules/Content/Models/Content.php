<?php

namespace Content\Models;

use Content\Support\Traits\ContentMutator;
use Course\Support\Traits\Status;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lesson\Support\Traits\BelongsToLesson;
use Lesson\Support\Traits\HasCourseThroughLesson;
use Library\Support\Traits\BelongsToLibrary;
use Pluma\Models\Model;

class Content extends Model
{
    use BelongsToLesson, HasCourseThroughLesson, BelongsToLibrary, ContentMutator, Status;

    protected $with = ['library', 'lesson'];

    protected $appends = [
        'current', 'locked', 'completed', 'incomplete',
        'url', 'interactive'
    ];

    protected $searchables = ['title', 'body', 'created_at', 'updated_at'];
}
