<?php

namespace Course\Models;

use Pluma\Models\Model;
use User\Support\Traits\BelongsToUser;

class Scormvar extends Model
{
    use BelongsToUser;

    protected $table = 'scormvars';

    protected $fillable = ['course_id', 'content_id', 'user_id', 'name', 'val'];

    protected $softDelete = false;
}
