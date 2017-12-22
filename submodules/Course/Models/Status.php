<?php

namespace Course\Models;

use Pluma\Models\Model;
use User\Support\Traits\BelongsToUser;

class Status extends Model
{
    use BelongsToUser;

    protected $table = 'scormvar_statuses';

    protected $fillable = ['course_id', 'content_id', 'user_id', 'name', 'status'];

    protected $softDelete = false;
}
