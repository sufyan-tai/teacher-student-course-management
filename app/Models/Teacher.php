<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Teacher extends Authenticatable
{
    use Notifiable; 

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
