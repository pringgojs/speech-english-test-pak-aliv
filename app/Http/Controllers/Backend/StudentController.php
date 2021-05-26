<?php

namespace App\Http\Controllers\Backend;

use App\Constants;
use App\Models\Student;
use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index()
    {
        access_is_allowed('read.student');

        $view = view('backend.student.index');
        $view->students =  Student::orderBy('created_at')->paginate(100);
        return $view;
    }

    public function create()
    {
        access_is_allowed('create.student');

        $view = view('backend.student.form');
        $view->student = new Student;
        return $view;
    }

    public function store(Request $request)
    {
        access_is_allowed('create.student');

        AdminHelper::createStudent($request);
        toaster_success(Constants::$SAVE_SUCCESS_MESSAGE);
        return redirect('student');
    }

    public function edit($id)
    {
        access_is_allowed('update.student');

        $view = view('backend.student.form');
        $view->student = Student::findOrFail($id);
        return $view;
    }

    public function update(Request $request)
    {
        access_is_allowed('update.student');

        AdminHelper::createStudent($request);
        toaster_success(Constants::$UPDATE_SUCCESS_MESSAGE);
        return redirect('student');
    }

    public function destroy($id)
    {
        access_is_allowed('delete.student');

        $model = Student::findOrFail($id);
        $delete = AdminHelper::delete($model);
        
        toaster_success(Constants::$DELETE_SUCCESS_MESSAGE);
        return redirect('student');
    }
}
