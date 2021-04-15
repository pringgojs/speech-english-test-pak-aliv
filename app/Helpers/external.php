<?php

use App\Models\Kategori;
use App\Exceptions\AppException;

/**
 * convert jenis kategori
 */
if (! function_exists('jenis_kategori')) {
    function jenis_kategori($tipe='')
    {
        $kategori = Kategori::whereTipe($tipe)->first();

        $tipe =  str_replace('_', ' ', $tipe);
        return ucwords($tipe);
    }
}

if (! function_exists('list_kategori')) {
    function list_kategori()
    {
        return Kategori::groupBy('tipe')->get();
    }
}