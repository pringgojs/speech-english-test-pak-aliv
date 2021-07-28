<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
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
