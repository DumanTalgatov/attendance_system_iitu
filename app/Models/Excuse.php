<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excuse extends Model
{
    use HasFactory;

    protected $fillable = ["excuse_text", "excuse_type", "excuse_file", "excuse_date", "student_id"];
}
