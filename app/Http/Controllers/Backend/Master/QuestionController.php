<?php

namespace App\Http\Controllers\Backend\Master;

use App\Models\Topic;
use App\Models\Question;
use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    public function index()
    {
        access_is_allowed('read.master.question');

        $view = view('backend.master.question.index');
        $view->questions =  Question::orderBy('topic_id')->with(['answers', 'topic'])->paginate(100);
        return $view;
    }

    public function create()
    {
        access_is_allowed('create.master.question');

        $view = view('backend.master.question.form');
        $view->question = new Question;
        $view->topics = Topic::all();
        return $view;
    }

    public function store(Request $request)
    {
        access_is_allowed('create.master.question');

        AdminHelper::createQuestion($request);
        toaster_success('create form success');
        return redirect('master/question');
    }

    public function edit($id)
    {
        access_is_allowed('update.master.question');

        $view = view('backend.master.question.form');
        $view->question = Question::findOrFail($id);
        $view->topics = Topic::all();

        return $view;
    }

    public function update(Request $request)
    {
        access_is_allowed('update.master.question');

        AdminHelper::createQuestion($request);
        toaster_success('create form success');
        return redirect('master/question');
    }

    public function destroy($id)
    {
        access_is_allowed('delete.master.question');

        $model = Question::findOrFail($id);
        $delete = AdminHelper::delete($model);
        
        toaster_success('delete form success');
        return redirect('master/question');
    }
}
