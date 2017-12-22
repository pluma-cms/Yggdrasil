<?php

namespace Lesson\Models;

use Assignment\Support\Traits\BelongsToAssignment;
use Content\Support\Traits\HasManyContents;
use Course\Support\Traits\BelongsToCourse;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lesson\Support\Mutators\LessonMutator;
use Pluma\Models\Model;

class Lesson extends Model
{
    use BelongsToCourse, HasManyContents, BelongsToAssignment, LessonMutator;

    protected $with = [];

    protected $appends = [];

    protected $searchables = ['created_at', 'updated_at'];
}
