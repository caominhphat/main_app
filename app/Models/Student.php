<?php

namespace App\Models;

use App\Events\ItemCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Student extends App
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'birth_day', 'delete_flag'];
    protected $dispatchesEvents = [
        'created' => ItemCreated::class,
    ];

    public function subjects() {
        return $this->belongsToMany(Subject::class, 'student_subject', 'student_id', 'subject_id');
    }

    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }
}
