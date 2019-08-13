<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public $timestamps = false;

    public function getStatusAttribute()
    {
        return (Registration::where('course_id', $this->id)->count() < $this->capacity) ? "available" : "unavailable";
    }
}
