<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineSchedule extends Model
{
    use HasFactory;

    protected $fillable = ["weekday", "course_id", "group_id", "lesson_type", "start_time", "end_time"];
}
