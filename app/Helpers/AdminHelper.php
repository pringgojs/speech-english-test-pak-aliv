<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Topic;
use App\Models\Question;
use App\Helpers\FileHelper;
use App\Models\QuestionAnswer;
use App\Exceptions\AppException;
use Illuminate\Support\Facades\DB;

class AdminHelper
{
    public static function save($model)
    {
        try {
            $model->save();
            return $model;
        } catch (\Exception $e) {
            dd($e);
            throw new AppException("Failed to save data", 503);
        }
    }

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
        // dd($model);

        /** drop answer exist */
        if ($request->id) {
            QuestionAnswer::where('topic_id', $model->id)->delete();
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
}
