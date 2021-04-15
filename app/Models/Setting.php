<?php

namespace App\Models;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';   
    public $timestamps = false;

    public static function getValue($key)
    {
        $setting = Setting::where('key', $key)->first();
        if ($setting) return $setting->value;
        return null;
    }
}
