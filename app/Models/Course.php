<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title', 'teacher_id'];

    // Teacher of course
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // ✅ Students enrolled in course
    public function students()
    {
        return $this->belongsToMany(
            User::class,
            'student_courses',   // pivot table
            'course_id',
            'student_id'
        );
    }
}
