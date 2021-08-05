<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
