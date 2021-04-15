<?php

namespace App\Http\Controllers\Backend;

use App\Models\Kapal;
use App\Models\Produk;
use App\Models\Kategori;
use DocxMerge\DocxMerge;
use App\Models\KodeMeter;
use App\Models\BunkerUmum;
use App\Models\FormBunker;
use App\Helpers\FileHelper;
use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use App\Models\PosisiDermaga;
use PhpOffice\PhpWord\Settings;
use App\Models\BunkerUmumDetail;
use PhpOffice\PhpWord\IOFactory;
use App\Http\Controllers\Controller;

class BunkerUmumController extends Controller
{
    public function index()
    {
        access_is_allowed('read.bunker.umum');

        $view = view('backend.bunker-umum.index');
        $view->bunker_umums =  BunkerUmum::search()->orderBy('updated_at', 'desc')->paginate(20);
        $view->list_pelaksanaan = Kategori::pelaksanaan()->get();
        $view->list_kapal = Kapal::bunkerUmum()->get();
        $view->list_jenis_kapal = Kategori::jenisKapal()->get();
        $view->list_posisi_dermaga = PosisiDermaga::bunkerUmum()->get();

        return $view;
    }

    public function create()
    {
        access_is_allowed('create.bunker.umum');

        $view = view('backend.bunker-umum.create');
        $view->list_pelaksanaan = Kategori::pelaksanaan()->get();
        $view->list_agen_kapal = Kategori::agenKapal()->get();
        $view->list_jenis_kapal = Kategori::jenisKapal()->get();
        $view->list_harga = Kategori::harga()->get();
        $view->list_kapal = Kapal::bunkerUmum()->get();
        $view->list_posisi_dermaga = PosisiDermaga::bunkerUmum()->get();
        $view->list_produk = Produk::bunkerUmum()->get();
        $view->list_kode_meter = KodeMeter::bunkerUmum()->get();
        $view->list_pemberi_order = Kategori::pemberiOrder()->get();

        return $view;
    }

    public function store(Request $request)
    {
        access_is_allowed('create.bunker.umum');
        
        \DB::beginTransaction();

        $form_bunker = FormBunker::init();
        $bunker_umum = AdminHelper::createBunkerUmum($form_bunker, $request);
        FormBunker::updateForm($form_bunker, get_class(new BunkerUmum), $bunker_umum->id);
        // AdminHelper::createBunkerUmumDetail($request, $bunker_umum);
        
        \DB::commit();

        toaster_success('create form success');
        return redirect('bunker-umum/create-step-2/'.$bunker_umum->id);
    }

    public function createStep2($id)
    {
        $view = view('backend.tabel-astm.create');
        $view->list_produk = Produk::bunkerUmum()->get();
        $view->list_kode_meter = KodeMeter::bunkerUmum()->get();
        $view->pelayanan = BunkerUmum::findOrFail($id);
        $view->link_store = url('bunker-umum/create-step-2');
        $view->link_selesai = url('bunker-umum/'.$id);
        $view->nomer_order = $view->pelayanan->form->nomer_order;
        $view->detail = '';
        $view->label = 'Bungker Umum';
        return $view;
    }

    public function storeStep2(Request $request)
    {
        \DB::beginTransaction();
        
        $bunker_umum = BunkerUmum::findOrFail($request->pelayanan_id);
        $detail = AdminHelper::createUpdateGlobalAstmDetail($request, $bunker_umum, $request->detail_id ? BunkerUmumDetail::findOrFail($request->detail_id) : new BunkerUmumDetail);
        \DB::commit();

        toaster_success('Produk berhasil ditambahkan');
        
        if ($request->is_new_product == 2) {
            return redirect('bunker-umum/create-step-2/'.$bunker_umum->id);
        }

        return redirect('bunker-umum/'.$bunker_umum->id);
    }

    public function show($id)
    {
        access_is_allowed('read.bunker.umum');

        $view = view('backend.bunker-umum.show');
        $view->bunker_umum = BunkerUmum::findOrFail($id);
        return $view;
    }

    public function edit($id)
    {
        access_is_allowed('update.bunker.umum');

        $view = view('backend.bunker-umum.edit');
        $view->bunker_umum = BunkerUmum::findOrFail($id);
        $view->list_pelaksanaan = Kategori::pelaksanaan()->get();
        $view->list_agen_kapal = Kategori::agenKapal()->get();
        $view->list_pemberi_order = Kategori::pemberiOrder()->get();
        $view->list_jenis_kapal = Kategori::jenisKapal()->get();
        $view->list_kapal = Kapal::bunkerUmum()->get();
        $view->list_posisi_dermaga = PosisiDermaga::bunkerUmum()->get();
        $view->list_produk = Produk::bunkerUmum()->get();
        $view->list_kode_meter = KodeMeter::bunkerUmum()->get();
        $view->list_harga = Kategori::harga()->get();

        return $view;
    }
    
    public function update(Request $request, $id)
    {
        access_is_allowed('update.bunker.umum');
        $bunker_umum = BunkerUmum::findOrFail($id);

        AdminHelper::createBunkerUmum($bunker_umum->form, $request, $id);
        toaster_success('update form success');
        return redirect('bunker-umum/'.$id);

    }

    public function destroy($id)
    {
        access_is_allowed('delete.bunker.umum');

        $type = BunkerUmum::findOrFail($id);
        $delete = AdminHelper::delete($type);
        
        toaster_success('delete form success');
        return redirect('bunker-umum');
    }

    public function printOrderPelaksanaan($id)
    {
        $bunker_umum = BunkerUmum::findOrFail($id);

        $data = [
            'title' => 'Cetak Order Pelaksanaan',
            'bunker_umum' => $bunker_umum,
        ];

        $pdf = \PDF::loadView('backend.bunker-umum.print-order-pelaksanaan', $data);
        return $pdf->stream();
    }

    public function printMeterRead($id)
    {
        $bunker_umum = BunkerUmum::findOrFail($id);

        $data = [
            'title' => 'Cetak Meter Read',
            'bunker_umum' => $bunker_umum,
        ];

        $pdf = \PDF::loadView('backend.bunker-umum.print-meter-read', $data);
        return $pdf->stream();
    }

    
    public function printSuratPernyataan($id)
    {
        $bunker_umum = BunkerUmum::findOrFail($id);

        $file = public_path('template/bunker-umum-peryataan.docx');
        $phpword = new \PhpOffice\PhpWord\TemplateProcessor($file);
        
        $search_replace_array = array(
            'kapal'=> $bunker_umum->kapal->nama,
            'tanggal'=> date_format_view($bunker_umum->tanggal, false),
            'loading_supervisor' => $bunker_umum->loading_supervisor

        );
        $phpword->setValueAdvanced($search_replace_array);
        /** Generate TTD */
        if ($bunker_umum->ttd_loading_supervisor) {
            $img = [
                'path' => public_path($bunker_umum->ttd_loading_supervisor),
                'width' => 80,
                'height' => 80
            ];
            $phpword->setImageValue('ttd_loading_supervisor', $img);
        } else {
            $search_replace_array = array(
                'ttd_loading_supervisor' => ''
            );
            $phpword->setValueAdvanced($search_replace_array);
        }

        $file_name = date('YmdHis').'BunkerUmumSuratPernyataan.docx';
        $phpword->saveAs($file_name);
        return response()->download($file_name)->deleteFileAfterSend(true);
    }

    public function printRfb($id)
    {
        $bunker_umum = BunkerUmum::findOrFail($id);

        $file = public_path('template/bunker-umum-rfb.docx');
        
        $file_name = [];
        foreach ($bunker_umum->details as $detail) {
            $phpword = new \PhpOffice\PhpWord\TemplateProcessor($file);
            $kl_15 = $detail->pelaksanaan_liter_15c * 1000;
            $search_replace_array = array(
                'loading_order'=> $bunker_umum->nomer_loading_order_1 .' Tgl. ' . date_format_view($bunker_umum->tanggal_loading_order_1),
                'agen'=> $bunker_umum->getNamaAgen(),
                'nomer_order'=> $bunker_umum->form->nomer_order,
                'shipment_no'=> $bunker_umum->shipment_no,
                'pemberi_order'=> $bunker_umum->pemberi_order,
                'posisi_dermaga'=> $bunker_umum->posisiDermaga->nama,
                'produk'=> $detail->produk->nama,
                'kapal'=> $bunker_umum->kapal->nama,
                'tanggal'=> date_format_view($bunker_umum->tanggal, false),
                'pelaksanaan_longton'=>  $detail? format_price($detail->pelaksanaan_long_ton, 3) : 0,
                'pelaksanaan_metricton'=>  $detail? format_price($detail->pelaksanaan_metric_ton, 3) : 0,
                'quantity'=>  $detail? format_price($detail->quantity, 0) : 0,
                'pelaksanaan_liter15c'=>  $detail? format_price($kl_15, 0) : 0,
                'pelaksanaan_barrels'=>  $detail? format_price($detail->pelaksanaan_barrels, 3) : 0,
                'temp'=>  $detail? format_price($detail->temp_obsd, 2) : 0,
                'density_obsd'=>  $detail? format_price($detail->density_obsd, 3) : 0,
                'density_15c' => $detail?  format_price($detail->density_15c, 4) : 0,
            );
            $phpword->setValueAdvanced($search_replace_array);

            /** Set TTD */
            if ($bunker_umum->ttd_pemberi_order) {
                $img = [
                    'path' => public_path($bunker_umum->ttd_pemberi_order),
                    'width' => 40,
                    'height' => 40
                ];
                $phpword->setImageValue('ttd_pemberi_order', $img);
            } else {
                $search_replace_array = array(
                    'ttd_pemberi_order '=> ''
                );
                $phpword->setValueAdvanced($search_replace_array);
            }

            $name = $detail->id . ' Bunker Umum Rfb.docx';
            array_push($file_name, $name);

            $phpword->saveAs($name);
        }

        /** Docx Merge */
        $full_file_name = public_path('temp/' . date('ymdHis') . ' bunker-umum-rfb.docx');
        $docx_merge = new DocxMerge();
        $docx_merge->merge($file_name, $full_file_name);

        /** Remove file part of part */
        \File::delete($file_name);

        /** Docx download */
        return response()->download($full_file_name)->deleteFileAfterSend(true);

    }

    /** bunker fee */
    public function _uploadBunkerFee($id)
    {
        $view = view('backend.bunker-umum._bunker-fee');
        $view->bunker_umum = BunkerUmum::findOrFail($id);
        return $view;
    }

    public function _uploadBunkerFeeStore(Request $request)
    {
        $file = $request->file;
        $bunker_umum = BunkerUmum::findOrFail($request->bunker_umum_id);
        if ($file) {
            $bunker_umum->file_bunker_fee =  FileHelper::upload($file, 'uploads/bunker-fee/');
        }
        $bunker_umum->save();

        return 1;
    }

    public function _deleteFileBunkerFee(Request $request, $id)
    {
        $bunker_umum = BunkerUmum::findOrFail($id);
        $bunker_umum->file_bunker_fee = null;
        $bunker_umum->save();
        return 1;
    }
}
