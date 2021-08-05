<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Topic;
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
        $is_valid = FrontHelper::nextQuestion($decrypt);
        if (!$is_valid) {
            /** TODO: redirect to result */
            return redirect('front/result/'.$token);
        }


        $view = view('frontend.form');
        $view->question = FrontHelper::nextQuestion($decrypt);
        $view->token = $token;
        return $view;
    }

    public function store(Request $request)
    {
        $answer = FrontHelper::storeAnswer($request->all());

        return $request->all();
    }

    
    public function result($token)
    {
        $decrypt = decrypt($token);
        $decrypt = explode('.', $decrypt);
        $where = [
            'group_id' => $decrypt[0],
            'topic_id' => $decrypt[1],
            'student_id' => $decrypt[2]
        ];

        $view = view('frontend.result');
        $view->student_answers = StudentAnswer::where($where)->get();
        $view->total_score = StudentAnswer::where($where)->sum('score');
        $view->topic = Topic::find($decrypt[1]);
        return $view;
    }
}
