<?php

namespace Package\Models;

use Catalogue\Support\Scopes\OfCatalogue;
use Content\Support\Traits\BelongsToContent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Library\Models\Library;

class Package extends Library
{
    use SoftDeletes, OfCatalogue, BelongsToContent;

    protected $table = 'library';

    protected $with = ['content'];

    protected $searchables = ['created_at', 'updated_at'];
}
