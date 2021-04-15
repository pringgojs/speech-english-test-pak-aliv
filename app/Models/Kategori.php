<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';   
    public $timestamps = false;

    public function scopePelaksanaan($q)
    {
        $q->whereTipe('pelaksanaan');
    }

    public function scopeAgenKapal($q)
    {
        $q->whereTipe('agen_kapal');
    }

    public function scopeJenisKapal($q)
    {
        $q->whereTipe('jenis_kapal');
    }

    public function scopeHarga($q)
    {
        $q->whereTipe('harga');
    }

    public function scopePemberiOrder($q)
    {
        $q->whereTipe('pemberi_order');
    }
}
