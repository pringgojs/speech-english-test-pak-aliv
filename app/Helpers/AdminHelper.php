<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Kapal;
use App\Models\Rapat;
use App\Models\Ownuse;
use App\Models\Produk;
use App\Models\Customer;
use App\Models\Kategori;
use App\Models\BunkerFee;
use App\Models\Inventory;
use App\Models\KodeMeter;
use App\Models\BunkerUmum;
use App\Models\LoadingPln;
use App\Models\Submission;
use App\Helpers\FileHelper;
use App\Models\Certificate;
use App\Models\LoadingApms;
use App\Models\RapatDetail;
use App\Helpers\AdminHelper;
use App\Models\OwnuseDetail;
use App\Models\PTPPFollowUp;
use App\Helpers\NumberHelper;
use App\Models\PosisiDermaga;
use App\Models\SubmissionFile;
use App\Models\LoadingApmsSpbu;
use App\Models\PTPPVerificator;
use App\Exceptions\AppException;
use App\Models\BunkerUmumDetail;
use App\Models\InventoryHistory;
use App\Models\PTPPFollowUpFile;
use App\Models\NomerBillOfLading;
use App\Models\PTPPFollowUpDetail;
use Illuminate\Support\Facades\DB;
use App\Models\MaintenanceActivity;
use App\Models\ItemMaintenanceActivity;
use App\Models\MaintenanceActivityHistory;

class AdminHelper
{
    public static function delete($model)
    {
        try{
            $model->delete();
            return true;
        } catch (\Exception $e) {
            throw new AppException("Woops, data can't be delete because is used by another form", 503);
        }
    }

    /** Kode meter */
    public static function createKodeMeter($request, $id='')
    {
        DB::beginTransaction();
        $kode_meter = $id ? KodeMeter::findOrFail($id) : new KodeMeter;
        $kode_meter->kode = $request->input('kode');
        $kode_meter->satuan = $request->input('satuan');
        $kode_meter->pelaksanaan_id = $request->input('pelaksanaan_id');

        try{
            $kode_meter->save();
        } catch (\Exception $e) {
            throw new AppException("Failed to save data", 503);
        }
        
        DB::commit();
        return $kode_meter;
    }

    public static function createPosisiDermaga($request, $id='')
    {
        DB::beginTransaction();
        $model = $id ? PosisiDermaga::findOrFail($id) : new PosisiDermaga;
        $model->nama = $request->input('nama');
        $model->pelaksanaan_id = $request->input('pelaksanaan_id');

        try{
            $model->save();
        } catch (\Exception $e) {
            throw new AppException("Failed to save data", 503);
        }
        
        DB::commit();
        return $model;
    }
    
    /** Produk */
    public static function createProduk($request, $id='')
    {
        DB::beginTransaction();
        $produk = $id ? Produk::findOrFail($id) : new Produk;
        $produk->nama = $request->input('nama');
        $produk->pelaksanaan_id = $request->input('pelaksanaan_id');
        try{
            $produk->save();
        } catch (\Exception $e) {
            throw new AppException("Failed to save data", 503);
        }
        
        DB::commit();
        return $produk;
    }

    /** Kategori */
    public static function createKategori($request, $id='')
    {
        
        DB::beginTransaction();
        $category = $id ? Kategori::findOrFail($id) : new Kategori;
        $category->nama = $request->input('nama');
        $category->tipe = $request->input('tipe');
        if ($category->tipe == 'pemberi_order') {
            $category->option = $request->input('option');
        }
        try{
            $category->save();
        } catch (\Exception $e) {
            throw new AppException("Failed to save data", 503);
        }
        
        DB::commit();
        return $category;
    }

    /** Kapal */
    public static function createKapal($request, $id='')
    {
        DB::beginTransaction();
        $kapal = $id ? Kapal::findOrFail($id) : new Kapal;
        $kapal->nama = $request->input('nama');
        $kapal->nomer_blb = $request->input('nomer_blb');
        $kapal->kapasitas_tangki_tribun = $request->input('kapasitas_tangki_tribun');
        $kapal->pelaksanaan_id = $request->input('pelaksanaan_id');
        $kapal->agen_kapal_id = $request->input('agen_kapal_id');
        $kapal->jenis_kapal_id = $request->input('jenis_kapal_id');

        try {
            $kapal->save();
        } catch (\Exception $e){
            throw new AppException("Failed to save data", 503);
        }

        DB::commit();
        return $kapal;
    }

    /** rapat */
    public static function createRapat($request, $id='')
    {
        $id = $request->id;
        DB::beginTransaction();
        $rapat = $id ? Rapat::findOrFail($id) : new Rapat;
        $rapat->tanggal = $request->input('tanggal') ? Carbon::createFromFormat('m/d/Y g:i A', $request->input('tanggal')) : null;
        
        try {
            $rapat->save();
            $arr_nama_kapal = $request->nama_kapal;
            if ($id) {
                RapatDetail::where('rapat_id', $id)->delete();
            }
            foreach ($arr_nama_kapal as $key => $nama_kapal) {
                $detail = new RapatDetail;
                $detail->rapat_id = $rapat->id;
                $detail->nama_kapal = $nama_kapal;
                $detail->pit = $request->pit[$key];
                $detail->tanggal_sandar = new Carbon($request->tanggal_sandar[$key]);
                $detail->jam_sandar = $request->jam_sandar[$key];
                $detail->save();
            }

        } catch (\Exception $e){
            throw new AppException("Failed to save data", 503);
        }

        DB::commit();
        return $rapat;
    }

    /** customer */
    public static function createCustomer($request, $id='')
    {
        $id = $request->id;
        DB::beginTransaction();
        $model = $id ? Customer::findOrFail($id) : new Customer;
        $model->email = $request->input('email');
        $model->nama = $request->input('nama');
        $model->agen_id = $request->input('agen_id');

        try {
            $model->save();
        } catch (\Exception $e){
            throw new AppException("Failed to save data", 503);
        }

        DB::commit();
        return $model;
    }

    /** ownuse */
    public static function createOwnuse($form_bunker, $request, $id='')
    {
        $tanggal = Carbon::createFromFormat('m/d/Y g:i A', $request->input('tanggal'));
        DB::beginTransaction();
        $ownuse = $id ? Ownuse::findOrFail($id) : new Ownuse;
        
        $ownuse->form_bunker_id = $form_bunker->id;
        $ownuse->tanggal = $tanggal;
        $ownuse->nomer_receipt_for_bunker = $form_bunker->nomer_order; // Set sama dengan ID
        $ownuse->agen = $request->input('agen');
        $ownuse->posisi_dermaga_id = $request->input('posisi_dermaga_id');
        $ownuse->nomer_fax_persetujuan = $request->input('nomer_fax_persetujuan');
        $ownuse->tanggal_fax_persetujuan = $request->input('tanggal_fax_persetujuan') ? Carbon::createFromFormat('m/d/Y g:i A', $request->input('tanggal_fax_persetujuan')) : null;
        $ownuse->nomer_surat_permohonan = $request->input('nomer_surat_permohonan');
        $ownuse->tanggal_surat_permohonan = $request->input('tanggal_surat_permohonan') ? Carbon::createFromFormat('m/d/Y g:i A', $request->input('tanggal_surat_permohonan')) : null;
        $ownuse->kapal_id = $request->input('kapal_id');
        $ownuse->reservation_number = $request->input('reservation_number');
        $ownuse->reservation_number_2 = $request->input('reservation_number_2');
        $ownuse->reservation_number_3 = $request->input('reservation_number_3');
        $ownuse->spv_receiving = $request->input('pemberi_order');
        $ownuse->pelaksana_bunker = $request->input('pelaksana_bunker');
        $ownuse->pemberi_order = $request->input('pemberi_order');
        $ownuse->created_by = auth()->user()->id;
        try {
            $ownuse->save();
        } catch (\Exception $e){
            throw new AppException("Failed to save data", 503);
        }
        
        DB::commit();
        return $ownuse;
    }

    /**
     * Digunakan untuk menyimpan semua data Detail dari ASTM
     * Ownuse, bungker umum, loading pln, loading apms
     * @param $request
     * @param $parent { Ownuse, LoadingPLN, BunkerUmum}
     * @param $child { detail dari masing-masing parent : new Detail}
     */
    public static function createUpdateGlobalAstmDetail($request, $parent, $detail)
    {
        DB::beginTransaction();

        $produk_id = $request->input('produk_id');
        $quantity = $request->input('quantity');
        $ex_tangki_timbun_no = $request->input('ex_tangki_timbun');
        $density_obsd = $request->input('density_obsvd');
        $temp_obsd = $request->input('temp');
        $density_15c = $request->input('density_15c');
        $temp_density_15c = $request->input('temp_1');
        $volume_c_factor = $request->input('tabel_54');
        $kl_obsd = $request->input('kl_observed');
        $kl_15c = $request->input('kl_15c');
        $long_ton = $request->input('weight_in_longtons');
        $metric_ton = $request->input('weight_in_metric_ton');
        $barrels = $request->input('volume_in_barrels');
        $kode_meter_id = $request->input('kode_meter_id');
        $totalisator_awal = $request->input('totalisator_awal');
        $totalisator_akhir = $request->input('totalisator_akhir');
        $jam_awal = $request->input('jam_awal') ? Carbon::createFromFormat('m/d/Y g:i A', $request->input('jam_awal')) : null;
        $jam_akhir = $request->input('jam_akhir') ? Carbon::createFromFormat('m/d/Y g:i A', $request->input('jam_akhir')) : null;
            if (get_class($parent) == get_class(new Ownuse)) {
                $detail->ownuse_id = $parent->id;
            } else if (get_class($parent) == get_class(new BunkerUmum)) {
                $detail->bunker_umum_id = $parent->id;
            } else if (get_class($parent) == get_class(new LoadingApms)) {
                $detail->loading_apms_id = $parent->id;
            }
            $detail->produk_id = $produk_id;
            $detail->quantity = NumberHelper::formatDB($quantity) * 1;
            $detail->ex_tangki_timbun_no = $ex_tangki_timbun_no;
            $detail->density_obsd = NumberHelper::formatDB($density_obsd) * 1;
            $detail->temp_obsd = NumberHelper::formatDB($temp_obsd) * 1;
            $detail->density_15c = NumberHelper::formatDB($density_15c) * 1;
            $detail->temp_density_15c = NumberHelper::formatDB($temp_density_15c) * 1;
            $detail->volume_c_factor = NumberHelper::formatDB($volume_c_factor) * 1;
            $detail->kl_obsd = NumberHelper::formatDB($kl_obsd) * 1;
            $detail->long_ton = NumberHelper::formatDB($long_ton) * 1;
            $detail->metric_ton = NumberHelper::formatDB($metric_ton) * 1;
            $detail->barrels = NumberHelper::formatDB($barrels) * 1;

            /** Hitung-hitungan order pelaksanaan */
            // $detail->pelaksanaan_liter_obsd = $detail->quantity;
            // $detail->pelaksanaan_liter_15c = $detail->pelaksanaan_liter_obsd * $detail->volume_c_factor;
            // $detail->pelaksanaan_long_ton = $detail->pelaksanaan_liter_15c * $detail->long_ton / 1000;
            // $detail->pelaksanaan_metric_ton = $detail->pelaksanaan_long_ton * $detail->metric_ton;
            // $detail->pelaksanaan_barrels = $detail->pelaksanaan_liter_15c * $detail->barrels / 1000;

            $detail->pelaksanaan_liter_obsd = $detail->quantity;
            $detail->pelaksanaan_liter_15c = NumberHelper::formatDB($kl_15c);
            $detail->pelaksanaan_long_ton = $detail->long_ton;
            $detail->pelaksanaan_metric_ton = $detail->metric_ton;
            $detail->pelaksanaan_barrels = $detail->barrels;

            $detail->kode_meter_id = NumberHelper::formatDB($kode_meter_id);
            $detail->totalisator_awal = NumberHelper::formatDB($totalisator_awal);
            $detail->totalisator_akhir = NumberHelper::formatDB($totalisator_akhir);
            $detail->totalisator_total = $detail->totalisator_akhir - $detail->totalisator_awal;
            $detail->jam_awal = $jam_awal;
            $detail->jam_akhir = $jam_akhir;

            /** Loading APMS */
            if (get_class($parent) == get_class(new LoadingApms)) {
                $detail->nomer_bill_of_lading = $request->input('nomer_bill_of_lading');
                $detail->tanggal_bill_of_lading = $request->input('tanggal_bill_of_lading') ? Carbon::createFromFormat('m/d/Y g:i A', $request->input('tanggal_bill_of_lading')) : null;
                $detail->tujuan_pengiriman = $request->input('tujuan_pengiriman');
                $detail->shipment_no = $request->input('shipment_no');
                $detail->nomer_loading_order = $request->input('nomer_loading_order');
                $detail->tanggal_loading_order = $request->input('tanggal_loading_order') ? Carbon::createFromFormat('m/d/Y g:i A', $request->input('tanggal_loading_order')) : null;
                if (!$detail->id) {
                    NomerBillOfLading::create($detail);
                }
                $detail->save();

                # update nomer bill of lading
                $nomer_bill_of_lading = NomerBillOfLading::where('nomer', $detail->nomer_bill_of_lading)->first();
                if ($nomer_bill_of_lading) {
                    $nomer_bill_of_lading->refer_to_id = $detail->id;
                    $nomer_bill_of_lading->save();
                }
            }

            try {
                $detail->save();
                DB::commit();

            } catch (\Exception $e){
                throw new AppException("Failed to save data", 503);
            }
        return $detail;
    }

    /** Bunker Umum */
    public static function createBunkerUmum($form_bunker, $request, $id='')
    {
        $tanggal = Carbon::createFromFormat('m/d/Y g:i A', $request->input('tanggal'));
        DB::beginTransaction();
        $bunker_umum = $id ? BunkerUmum::findOrFail($id) : new BunkerUmum;
        
        $bunker_umum->form_bunker_id = $form_bunker->id;
        $bunker_umum->tanggal = $tanggal;
        $bunker_umum->posisi_dermaga_id = $request->input('posisi_dermaga_id');
        $bunker_umum->nomer_receipt_for_bunker = null; // diambil dari nomer formulir
        $bunker_umum->agen = $request->input('agen_id');;
        $bunker_umum->fax_persetujuan = $request->input('fax_persetujuan') ? : null;
        $bunker_umum->surat_permohonan = $request->input('surat_permohonan') ? : null;
        $bunker_umum->kapal_id = $request->input('kapal_id');
        $bunker_umum->nomer_loading_order_1 = $request->input('nomer_loading_order_1');
        $bunker_umum->tanggal_loading_order_1 = $request->input('tanggal_loading_order_1') ? Carbon::createFromFormat('m/d/Y g:i A', $request->input('tanggal_loading_order_1')) : null;
        $bunker_umum->nomer_loading_order_2 = $request->input('nomer_loading_order_2');
        $bunker_umum->tanggal_loading_order_2 = $request->input('tanggal_loading_order_2') ? Carbon::createFromFormat('m/d/Y g:i A', $request->input('tanggal_loading_order_2')) : null;
        $bunker_umum->nomer_loading_order_3 = $request->input('nomer_loading_order_3');
        $bunker_umum->tanggal_loading_order_3 = $request->input('tanggal_loading_order_3') ? Carbon::createFromFormat('m/d/Y g:i A', $request->input('tanggal_loading_order_3')) : null;
        $bunker_umum->shipment_no = $request->input('shipment_no');
        $bunker_umum->harga_id = $request->input('harga_id');
        $bunker_umum->loading_supervisor = $request->input('pemberi_order');
        $bunker_umum->pelaksana_bunker = $request->input('pelaksana_bunker');
        $bunker_umum->pemberi_order = $request->input('pemberi_order');
        $bunker_umum->created_by = auth()->user()->id;
        try {
            $bunker_umum->save();
        } catch (\Exception $e){
            throw new AppException("Failed to save data", 503);
        }
        
        DB::commit();
        return $bunker_umum;
    }

    /** Loading Pln */
    public static function createLoadingPln($request)
    {
        $id = $request->loading_pln_id;
        $tanggal = Carbon::createFromFormat('m/d/Y g:i A', $request->input('tanggal'));
        DB::beginTransaction();
        $loading_pln = $id ? LoadingPln::findOrFail($id) : new LoadingPln;
        if (!$id) {
            $nomer_order = LoadingPln::number();
            $loading_pln->nomer_order = $nomer_order;
        }

        // dd($request->all());
        $loading_pln->tanggal_pelaksanaan = $tanggal;
        $loading_pln->kapal_id = $request->input('kapal_id') ? : null;
        $loading_pln->posisi_dermaga_id = $request->input('posisi_dermaga_id') ? : null;
        $loading_pln->tujuan_pengiriman = $request->input('tujuan_pengiriman') ? : null;
        $loading_pln->agen_pelaksana = $request->input('agen_pelaksana') ? : 'PT. PELNI CAB. TANJUNG WANGI';
        $loading_pln->agen_pelayaran = $request->input('agen_pelayaran') ? : 'PT. PELNI CAB. TANJUNG WANGI';
        $loading_pln->nomer_surat_permohonan = $request->input('nomer_surat_permohonan');
        $loading_pln->tanggal_surat_permohonan = $request->input('tanggal_surat_permohonan') ? Carbon::createFromFormat('m/d/Y g:i A', $request->input('tanggal_surat_permohonan')) : null;
        $loading_pln->nomer_loading_order = $request->input('nomer_loading_order');
        $loading_pln->tanggal_loading_order = $request->input('tanggal_loading_order') ? Carbon::createFromFormat('m/d/Y g:i A', $request->input('tanggal_loading_order')) : null;
        $loading_pln->nomer_bill_of_lading = $request->input('nomer_bill_of_lading');
        $loading_pln->tanggal_bill_of_lading = $request->input('tanggal_bill_of_lading') ? Carbon::createFromFormat('m/d/Y g:i A', $request->input('tanggal_bill_of_lading')) : null;
        $loading_pln->shipment_no = $request->input('shipment_no');
        $loading_pln->loading_supervisor = $request->input('pemberi_order');
        $loading_pln->loading_officer = $request->input('loading_officer');
        $loading_pln->pemberi_order = $request->input('pemberi_order') ? : 'Adam';

        $loading_pln->produk_id = $request->input('produk_id') ? : null;
        $loading_pln->quantity = format_db($request->input('total_quantity'));
        $loading_pln->ex_tangki_timbun_no = $request->input('ex_tangki_timbun_no');

        // Tabel astm
        $loading_pln->density_obsd = format_db($request->input('density_obsvd'));
        $loading_pln->temp_obsd = format_db($request->input('temp'));
        $loading_pln->density_15c = format_db($request->input('density_15c'));
        $loading_pln->volume_c_factor = format_db($request->input('tabel_54'));
        $loading_pln->long_ton = format_db($request->input('weight_in_longtons'));
        $loading_pln->metric_ton = format_db($request->input('weight_in_metric_ton'));
        $loading_pln->barrels = format_db($request->input('volume_in_barrels'));
        $loading_pln->temp_density_15c = format_db($request->input('temp_1'));
        $loading_pln->kl_obsd = format_db($request->input('kl_observed'));

        $loading_pln->pelaksanaan_liter_obsd = format_db($request->input('pelaksanaan_liter_obsd'));
        $loading_pln->pelaksanaan_liter_15c = format_db($request->input('pelaksanaan_liter_15c'));
        $loading_pln->pelaksanaan_long_ton = format_db($request->input('pelaksanaan_long_ton'));
        $loading_pln->pelaksanaan_metric_ton = format_db($request->input('pelaksanaan_metric_ton'));
        $loading_pln->pelaksanaan_barrels = format_db($request->input('pelaksanaan_barrels'));
        $loading_pln->kode_meter_id = $request->input('kode_meter_id') ? : null;
        $loading_pln->meter_awal = $request->input('meter_awal') ? format_db($request->input('meter_awal')) : 0;
        $loading_pln->meter_akhir = $request->input('meter_akhir') ? format_db($request->input('meter_akhir')) : 0;
        $loading_pln->meter_total = $loading_pln->meter_akhir - $loading_pln->meter_awal;
        $loading_pln->jam_awal = date('Y-m-d h:i:s');
        $loading_pln->jam_akhir = date('Y-m-d h:i:s');
        $loading_pln->created_by = auth()->user()->id;
        try {
            $loading_pln->save();
            if (!$id) {
                NomerBillOfLading::create($loading_pln);
            }
        } catch (\Exception $e){
            throw new AppException("Failed to save data", 503);
        }

        DB::commit();
        return $loading_pln;
    }

    /** Loading APMS */
    public static function createLoadingApms($request, $id='')
    {
        $tanggal = Carbon::createFromFormat('m/d/Y g:i A', $request->input('tanggal'));
        DB::beginTransaction();
        $loading_apms = $id ? LoadingApms::findOrFail($id) : new LoadingApms;
        if (!$id) {
            $nomer_order = LoadingApms::number();
            $loading_apms->nomer_order = $nomer_order;
        }
        $loading_apms->tanggal_pelaksanaan = $tanggal;
        $loading_apms->posisi_dermaga_id = $request->input('posisi_dermaga_id');
        $loading_apms->agen_pelaksana = $request->input('agen_pelaksana') ? : null;
        $loading_apms->agen_pelayaran = $request->input('agen_pelayaran') ? : null;
        
        // $loading_apms->nomer_bill_of_lading = $request->input('nomer_bill_of_lading');
        // $loading_apms->tanggal_bill_of_lading = $request->input('tanggal_bill_of_lading') ? Carbon::createFromFormat('m/d/Y g:i A', $request->input('tanggal_bill_of_lading')) : null;
        
        $loading_apms->kapal_id = $request->input('kapal_id');
        $loading_apms->loading_supervisor = $request->input('pemberi_order');
        $loading_apms->loading_officer = $request->input('loading_officer');
        $loading_apms->pemberi_order = $request->input('pemberi_order');
        $loading_apms->created_by = auth()->user()->id;

        try {
            $loading_apms->save();
        } catch (\Exception $e){
            throw new AppException("Failed to save data", 503);
        }
        
        DB::commit();
        return $loading_apms;
    }

    /** Mengambil jenis kode pelayanan
     * digunakan pada saat membuat tabel astm
     * untuk pengecekan totalisator awal
     */
    public static function getKodePelayanan($model)
    {
        /** Ownuse */
        if (get_class($model) == get_class(new Ownuse)) {
            return 1;
        }

        /** Bunker Umum */
        if (get_class($model) == get_class(new BunkerUmum)) {
            return 2;
        }

        /** Loading PLN */
        if (get_class($model) == get_class(new LoadingPln)) {
            return 3;
        }

        /** Loading Apms */
        if (get_class($model) == get_class(new LoadingApms)) {
            return 4;
        }
    }
}
