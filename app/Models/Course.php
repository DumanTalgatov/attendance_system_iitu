<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ["name", "course_type", "teacher_id"];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
