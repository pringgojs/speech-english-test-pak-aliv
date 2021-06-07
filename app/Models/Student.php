<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
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
