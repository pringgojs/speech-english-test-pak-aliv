<?php

namespace App\Http\Controllers\Backend\Master;

use App\Constants;
use App\Models\Topic;
use App\Models\Question;
use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QuestionAnswerVariant;

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

        $model = AdminHelper::createQuestion($request);
        toaster_success(Constants::$SAVE_SUCCESS_MESSAGE);
        return redirect('master/question/create-step-2/'.$model->id);
    }

    public function createStep2($id)
    {
        $view = view('backend.master.question.create-step-2');
        $view->question = Question::findOrFail($id);

        return $view;
    }

    public function storeStep2(Request $request)
    {
        $model = new QuestionAnswerVariant;
        $model->question_answer_id = $request->question_answer_id;
        $model->answer = $request->value;
        $model->save();

        return $model;
    }

    public function _deleteAnswerVariant($id)
    {
        $model = QuestionAnswerVariant::findOrFail($id);
        $model->delete();

        return 'success';
    }

    public function show($id)
    {
        $view = view('backend.master.question._show');
        $view->question = Question::findOrFail($id);
        return $view;
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
        toaster_success(Constants::$UPDATE_SUCCESS_MESSAGE);
        return redirect('master/question');
    }

    public function destroy($id)
    {
        access_is_allowed('delete.master.question');

        $model = Question::findOrFail($id);
        $delete = AdminHelper::delete($model);
        
        toaster_success(Constants::$DELETE_SUCCESS_MESSAGE);
        return redirect('master/question');
    }
}
