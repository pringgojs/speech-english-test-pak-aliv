<?php

namespace App\Helpers;

use App\User;
use Carbon\Carbon;
use App\Models\Group;
use App\Models\Topic;
use App\Models\Student;
use App\Models\Question;
use App\Models\GroupTopic;
use App\Helpers\FileHelper;
use App\Models\GroupStudent;
use App\Models\QuestionAnswer;
use App\Exceptions\AppException;
use Illuminate\Support\Facades\DB;

class AdminHelper
{
    /** save */
    public static function save($model)
    {
        try {
            $model->save();
            return $model;
        } catch (\Exception $e) {
            throw new AppException("Failed to save data", 503);
        }
    }

    /** delete */
    public static function delete($model)
    {
        try{
            $model->delete();
            return true;
        } catch (\Exception $e) {
            throw new AppException("Woops, data can't be delete because is used by another form", 503);
        }
    }


    /** Kategori */
    public static function createKategori($request, $id='')
    {
        DB::beginTransaction();
        $category = $id ? Kategori::findOrFail($id) : new Kategori;
        $category->nama = $request->input('nama');
        $category->tipe = $request->input('tipe');
        if ($category->tipe == 'pemberi_order') {
            $category->option = $request->input('option');
        }
        try{
            $category->save();
        } catch (\Exception $e) {
            throw new AppException("Failed to save data", 503);
        }
        
        DB::commit();
        return $category;
    }

    /** Topic */
    public static function createTopic($request)
    {
        $model = $request->id ? Topic::findOrFail($request->id) : new Topic;
        $model->name = $request->input('name');
        return self::save($model);
    }

    /** Question */
    public static function createQuestion($request)
    {
        $model = $request->id ? Question::findOrFail($request->id) : new Question;
        $model->question = $request->question;
        $model->topic_id = $request->topic_id;
        $model->serial_number = $request->serial_number;
        self::save($model);

        /** drop answer exist */
        if ($request->id) {
            QuestionAnswer::where('question_id', $model->id)->delete();
        }

        $answers = $request->answers;
        $scores = $request->scores;
        for ($i=0; $i < count($answers); $i++) { 
            $answer = new QuestionAnswer;
            $answer->question_id =  $model->id;
            $answer->answer = $answers[$i];
            $answer->score = $scores[$i];
            self::save($answer);
        }
    }

    /** Student */
    public static function createStudent($request)
    {
        DB::beginTransaction();
        $password = str_random(10);
        if (!$request->id) {
            $user = new User;
            $user->name;
            $user->password = bcrypt($password);
            $user->username = 'student';
            $user->save();

            $user->attachRole(2);
        }

        $model = $request->id ? Student::findOrFail($request->id) : new Student;
        $model->name = $request->input('name');
        $model->identity_number = $request->input('identity_number');
        $model->phone = $request->input('phone');
        $model->address = $request->input('address');
        if (!$request->id) {
            $model->user_id = $user->id;
            $model->password = $password;
        }

        self::save($model);
        DB::commit();
        return $model;
    }

    /** group */
    public static function createGroup($request)
    {
        $model = $request->id ? Group::findOrFail($request->id) : new Group;
        $model->name = $request->input('name');
        return self::save($model);
    }

    public static function createGroupStudent($request)
    {
        $student_id = $request->student_id;
        foreach ($student_id as $key => $id) {
            $check = GroupStudent::where('student_id', $id)->where('group_id', $request->group_id)->first();
            if ($check) continue;

            $model = new GroupStudent;
            $model->student_id = $id;
            $model->group_id = $request->group_id;
            self::save($model);
        }

        return 'OK';
    }

    public static function createGroupTopic($request)
    {
        $topic_id = $request->topic_id;
        foreach ($topic_id as $key => $id) {
            $check = GroupTopic::where('topic_id', $id)->where('group_id', $request->group_id)->first();
            if ($check) continue;

            $model = new GroupTopic;
            $model->topic_id = $id;
            $model->group_id = $request->group_id;
            self::save($model);
        }

        return 'OK';
    }
}
