<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Student;
use App\Helpers\FrontHelper;
use Illuminate\Http\Request;
use App\Models\StudentAnswer;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $view = view('frontend.index');
        $view->total_group = student()->groupStudents->count();
        $view->topics = Student::joinGroupStudent()
            ->joinGroupTopic()
            ->where('students.id', student()->id)
            ->select(['group_students.*', 'group_topics.*', 'students.*'])
            ->get();
        // dd($view->list_topic);
        return $view;
        
    }

    public function form($token)
    {
        /** format token: ($group_id.$topic_id.$student_id) */
        $decrypt = decrypt($token);
        $is_valid = FrontHelper::isValidForm($decrypt);
        if (!$is_valid) {
            /** TODO: redirect to result */
        }


        $view = view('frontend.form');
        $view->question = FrontHelper::nextQuestion($decrypt);
        $view->token = $token;
        return $view;
    }

    public function store(Request $request)
    {
        info($request->all());
        $answer = FrontHelper::storeAnswer($request->all());

        return $request->all();
    }

    
    public function result()
    {
        return view('frontend.result');
    }
}
