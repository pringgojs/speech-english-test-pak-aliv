<?php

use Illuminate\Support\Facades\Crypt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** CKeditor */
Route::post('ckeditor/image-upload-drag', 'CKEditorController@uploadDrag');
Route::post('ckeditor/image-upload', 'CKEditorController@upload')->name('ckeditor-upload');

/** Camera js */
Route::post('manual-upload', 'CameraController@manualUpload');
Route::get('camera/render-js', 'CameraController@renderJS');
Route::post('camera', 'CameraController@store');
Route::get('camera', 'CameraController@camera');

/** Notification */
Route::get('notification', 'Backend\NotificationController@index');
Route::get('notification/all', 'Backend\NotificationController@all');

/** User */
Route::group(['middleware' => 'auth'], function () {
    Route::get('/check-user', 'WelcomeController@checkUser');
    // User
    Route::post('profile', 'Backend\UserController@updateProfile');
    Route::get('profile', 'Backend\UserController@profile');
    Route::resource('user', 'Backend\UserController', ['except' => ['show']]);
    Route::group(['prefix' => 'user'], function () {
        Route::get('approve/{id}', 'Backend\UserController@approve');
        Route::get('reject/{id}', 'Backend\UserController@reject');
        Route::get('set-permission', 'Backend\UserController@setPermission');
        Route::get('{user_id}/{role_id}', 'Backend\UserController@permission');
        
    });
});

// Student
Route::group(['namespace' => 'Frontend', 'prefix' => 'front', 'middleware' => ['auth', 'role:student']], function () {
    Route::get('news/{id}/{any}', 'FrontendController@postDetail');
    Route::get('news', 'FrontendController@post');
    Route::get('history/{token}', 'FrontendController@history');
    Route::get('result/{token}', 'FrontendController@result');
    Route::post('store', 'FrontendController@store');
    Route::get('form/{token}', 'FrontendController@form');
    Route::get('/', 'FrontendController@index');
});

// Full Administrator
Route::group(['namespace' => 'Backend', 'middleware' => ['auth', 'role:administrator']], function () {
    Route::get('/', 'BackendController@index');
    Route::get('reject', 'BackendController@rejectForm');
    Route::post('reject', 'BackendController@reject');
    
    // Master
    Route::group(['prefix' => 'master', 'namespace' => 'Master'], function () {
        Route::delete('question/delete-answer-category/{id}', 'QuestionController@_deleteAnswerCategory');
        Route::delete('question/delete-answer-variant/{id}', 'QuestionController@_deleteAnswerVariant');
        Route::post('question/create-step-2', 'QuestionController@storeStep2');
        Route::get('question/create-step-2/{id}', 'QuestionController@createStep2');
        Route::get('question/{id}/detail', 'QuestionController@show');
        Route::post('question/answer-category', 'QuestionController@storeAnswerCategory');
        Route::resource('question', 'QuestionController');
        Route::resource('topic', 'TopicController');
        Route::resource('kategori', 'KategoriController');
        
    });
    
    Route::get('post/{id}/copy', 'PostController@copy');
    Route::resource('post', 'PostController');
    Route::get('report/detail/{id}', 'ReportController@_detail');
    Route::get('report', 'ReportController@index');
    
    Route::delete('group/delete-topic/{group_topic_id}', 'GroupController@deleteTopicGroup');
    Route::delete('group/delete-student/{group_student_id}', 'GroupController@deleteStudentGroup');
    Route::post('group/temp-add-student', 'GroupController@tempAddStudent');
    Route::post('group/create-step-3', 'GroupController@storeStep3');
    Route::get('group/create-step-3/{id}', 'GroupController@createStep3');
    Route::post('group/create-step-2', 'GroupController@storeStep2');
    Route::get('group/create-step-2/{id}', 'GroupController@createStep2');
    Route::resource('group', 'GroupController');
    Route::get('student/import-store-model', 'StudentController@importStoreModel');
    Route::get('student/import-download-template', 'StudentController@importDownloadTemplate');
    Route::post('student/import', 'StudentController@importStoreTemp');
    Route::get('student/import', 'StudentController@import');
    Route::resource('student', 'StudentController');
    Route::resource('setting', 'SettingController');



});

Auth::routes();
