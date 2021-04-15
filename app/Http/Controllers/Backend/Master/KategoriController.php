<?php

namespace App\Http\Controllers\Backend\Master;

use App\Models\Kategori;
use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function index()
    {
        access_is_allowed('read.master.kategori');

        $tipe = \Input::get('tipe');
        $view = view('backend.master.kategori.index');
        $view->categories =  Kategori::where(function($q) use ($tipe) {
            if ($tipe) $q->whereTipe($tipe);
        })->paginate(25);
        return $view;
    }

    public function create()
    {
        access_is_allowed('create.master.kategori');

        return view('backend.master.kategori.create');
    }

    public function store(Request $request)
    {
        access_is_allowed('create.master.kategori');

        $kategori = AdminHelper::createKategori($request);
        toaster_success('create form success');
        return redirect('master/kategori?tipe='.$kategori->tipe);
    }

    public function edit($id)
    {
        access_is_allowed('update.master.kategori');

        $view = view('backend.master.kategori.edit');
        $view->kategori = Kategori::findOrFail($id);
        return $view;
    }

    public function update(Request $request, $id)
    {
        access_is_allowed('update.master.kategori');

        $kategori = AdminHelper::createKategori($request, $id);
        toaster_success('create form success');
        return redirect('master/kategori?tipe='.$kategori->tipe);
    }

    public function destroy($id)
    {
        access_is_allowed('delete.master.kategori');

        $tipe = Kategori::findOrFail($id);
        $delete = AdminHelper::delete($tipe);
        
        toaster_success('delete form success');
        return redirect(url()->previous());
    }
}
