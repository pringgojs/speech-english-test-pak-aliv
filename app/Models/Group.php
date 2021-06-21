<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function student()
    {
        return $this->hasMany(GroupStudent::class);
    }

    public function topic()
    {
        return $this->hasMany(GroupTopic::class);
    }
}
