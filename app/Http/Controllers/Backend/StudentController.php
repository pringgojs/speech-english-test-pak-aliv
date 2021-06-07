<?php

namespace App\Http\Controllers\Backend;

use App\Constants;
use App\Models\Temp;
use App\Models\Student;
use App\Helpers\FileHelper;
use App\Helpers\AdminHelper;
use App\Helpers\ExcelHelper;
use Illuminate\Http\Request;
use App\Helpers\TempDataHelper;
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

    /** import */
    public function import()
    {
        $view = view('backend.student.import');
        $view->list_data_import = TempDataHelper::get('student.import', auth()->user()->id);
        return $view;   
    }

    /** download template */
    public function importDownloadTemplate()
    {
        $content = array(array('Name', 'Identity Number', 'Address', 'Phone'));
        
        $file_name = 'template-import-student';
        $sheet_name = 'Data Import';
        ExcelHelper::templateImport($file_name, $content, $sheet_name);
    }

    public function importStoreTemp(Request $request)
    {
        FileHelper::xlsValidate();
        try {
            $filePath = 'data-import/';
            $fileName = date('Y-m-d His') . '.xls';
            $fileLink = $filePath . $fileName;
            if (app('request')->hasFile('file')) {
                \Storage::put($fileLink, file_get_contents($request->file('file')));
            }
            $request = $request->input();
            \DB::beginTransaction();
            \Excel::selectSheets('Data Import')->load('storage/app/' . $fileLink, function ($reader) use ($request) {
                $results = $reader->get()->toArray();
                TempDataHelper::clear('student.import', auth()->user()->id);
                foreach ($results as $data) {
                    $temp_key = 'student.import';
                    $temp = new Temp;
                    $temp->user_id = auth()->user()->id;
                    $temp->name = $temp_key;
                    $temp->keys = serialize($data);
                    $temp->save();
                }
            });

            \DB::commit();
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            return redirect()->back();
        }

        toaster_success(Constants::$IMPORT_SUCCESS_MESSAGE);
        return redirect()->back();
    }

    public function importStoreModel()
    {   
        $list_data_import = TempDataHelper::get('student.import', auth()->user()->id);
        foreach ($list_data_import as $key => $import) {
            $model = Student::store($import);
        }

        TempDataHelper::clear('student.import', auth()->user()->id);

        toaster_success('success');
        return redirect()->back();

    }
}
