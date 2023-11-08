<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeForFriend extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'friend_id', 'code'];

}
