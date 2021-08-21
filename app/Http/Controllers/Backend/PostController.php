<?php

namespace App\Http\Controllers\Backend;

use App\Constants;
use App\Models\Post;
use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $view = view('backend.post.index');
        $view->posts = Post::search()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return $view;
    }

    public function create()
    {
        $view = view('backend.post.form');
        $view->post = new Post;
        return $view;
    }

    public function store(Request $request)
    {
        AdminHelper::createPost($request);
        toaster_success(Constants::$SAVE_SUCCESS_MESSAGE);
        return redirect('post');
    }

    public function edit($id)
    {
        $view = view('backend.post.form');
        $view->post = Post::findOrFail($id);
        return $view;
    }

    public function copy($id)
    {
        $view = view('backend.post.form');
        $view->post = Post::findOrFail($id);
        return $view;
    }

    public function update(Request $request, $id)
    {
        AdminHelper::createPost($request, $id);
        toaster_success(Constants::$UPDATE_SUCCESS_MESSAGE);
        return redirect('post');
    }

    public function destroy($id)
    {
        $type = Post::findOrFail($id);
        $delete = AdminHelper::delete($type);
        
        toaster_success('delete form success');
        return redirect('post');
    }
}
