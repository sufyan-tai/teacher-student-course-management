<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; 
use App\Models\Course;

class User extends Authenticatable
{
    use Notifiable;   

    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password'];

    
    public function teachingCourses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    
    public function courses()
    {
        return $this->belongsToMany(
            Course::class,
            'student_courses',
            'student_id',
            'course_id'
        );
    }
}