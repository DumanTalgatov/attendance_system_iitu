<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFriend extends Model
{
    use HasFactory;

    protected $fillable = ["student_id", "friend_id", "code", "permission", "count"];
}
