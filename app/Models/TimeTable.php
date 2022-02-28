<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimeTable extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'day',
        'lesson',
        'course_id',
    ];

    public function courses()
    {
        $this->belongsTo(Course::class);
    }
}
