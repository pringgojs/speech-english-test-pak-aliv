<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $view = view('frontend.index');
        $view->total_group = student()->groupStudents->count();
        $view->total_topic = Student::joinGroupStudent()
            ->joinGroupTopic()
            ->where('students.id', student()->id)
            ->select(['group_students.*', 'group_topics.*', 'students.*'])
            ->get();
        return $view;
        
    }

    public function form()
    {
        return view('frontend.form');
    }

    public function result()
    {
        return view('frontend.result');
    }
}
