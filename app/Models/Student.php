<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function scopeJoinGroupStudent($q)
    {
        $q->join('group_students', 'group_students.student_id', '=', 'students.id');
    }

    public function scopeJoinGroupTopic($q)
    {
        $q->join('group_topics', 'group_topics.group_id', '=', 'group_students.group_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function groupStudents()
    {
        return $this->hasMany(GroupStudent::class);
    }

    public static function store($data = [])
    {
        $password = str_random(10);
        
        $user = new User;
        $user->name;
        $user->password = bcrypt($password);
        $user->username = 'student';
        $user->email = $user->password.'@gmail.com';
        $user->save();

        $user->attachRole(2);
        

        $model = new Student;
        $model->name = $data['name'];
        $model->identity_number = $data['identity_number'];
        $model->phone = $data['phone'];
        $model->address = $data['address'];
        $model->user_id = $user->id;
        $model->password = $password;
        $model->save();

        return $model;
    }
}
