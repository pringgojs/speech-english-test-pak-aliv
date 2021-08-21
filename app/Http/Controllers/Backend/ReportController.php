<?php

namespace App\Http\Controllers\Backend;

use App\Models\Group;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Models\StudentAnswer;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index()
    {
        $view = view('backend.report.index');
        $view->reports = StudentAnswer::search()->orderBy('student_answers.id', 'desc')->paginate(20);
        $view->groups = Group::all();
        $view->topics = Topic::all();
        return $view;
    }
}
