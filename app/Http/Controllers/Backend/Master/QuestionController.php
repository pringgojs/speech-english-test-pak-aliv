<?php

namespace App\Http\Controllers\Backend\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    public function index()
    {
        access_is_allowed('read.master.question');

        $view = view('backend.master.question.index');
        $view->questions =  Question::all();
        return $view;
    }

    public function create()
    {
        access_is_allowed('create.master.question');

        $view = view('backend.master.question.create');
        $view->question = new Question;
        return $view;
    }

    public function store(Request $request)
    {
        access_is_allowed('create.master.question');

        AdminHelper::createTopic($request);
        toaster_success('create form success');
        return redirect('master/question');
    }

    public function edit($id)
    {
        access_is_allowed('update.master.question');

        $view = view('backend.master.question.form');
        $view->question = Question::findOrFail($id);
        return $view;
    }

    public function update(Request $request, $id)
    {
        access_is_allowed('update.master.question');

        AdminHelper::createTopic($request, $id);
        toaster_success('create form success');
        return redirect('master/question');
    }

    public function destroy($id)
    {
        access_is_allowed('delete.master.question');

        $type = Question::findOrFail($id);
        $delete = AdminHelper::delete($type);
        
        toaster_success('delete form success');
        return redirect('master/question');
    }
}
