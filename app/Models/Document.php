<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Document extends Model
{
    protected $table = 'documents';
    protected $fillable = ['id', 'documentable_type', 'documentable_id', 'url'];
    public function documentable(): MorphTo
    {
        return $this->morphTo();
    }
}
