<?php

namespace Course\Models;

use Course\Support\Scopes\EnrolledToACourse;
use Course\Support\Traits\BelongsToManyCourses;
use Course\Support\Traits\CourseUserMutator;
use User\Models\User as BaseUser;

class User extends BaseUser
{
    use EnrolledToACourse, BelongsToManyCourses, CourseUserMutator;

    protected $with = ['roles'];

    protected $appends = ['handlename', 'propername', 'displayname', 'displayrole', 'fullname', 'created', 'modified'];

    protected $searchables = ['firstname', 'middlename', 'lastname', 'username', 'prefixname', 'email'];
}
