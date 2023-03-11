<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
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

    public function subjects() {
        return $this->belongsToMany(Subject::class, 'student_subject', 'student_id', 'subject_id');
    }
}
