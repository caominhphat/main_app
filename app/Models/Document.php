<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Document extends App
{
    protected $table = 'documents';
    protected $fillable = ['id', 'documentable_type', 'documentable_id', 'url', 'name'];
    public function documentable(): MorphTo
    {
        return $this->morphTo();
    }
}
