<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Facade;

class ToasterHelper extends Facade
{
    public static function set($title, $message, $icon, $sticky = 'true')
    {
        for ($i = 0; $i <= 10; $i++) {
            if (!session()->has('toaster_message_' . $i)) {
                session()->flash('toaster_title_' . $i, $title);
                session()->flash('toaster_icon_' . $i, $icon);
                session()->flash('toaster_message_' . $i, $message);
                session()->flash('toaster_sticky_' . $i, self::castToString($sticky));
                break;
            }
        }
    }

    public static function success($message, $sticky = 'true')
    {
        for ($i = 0; $i <= 10; $i++) {
            if (!session()->has('toaster_message_' . $i)) {
                session()->flash('toaster_title_' . $i, 'Success');
                session()->flash('toaster_icon_' . $i, 'success');
                session()->flash('toaster_message_' . $i, $message);
                session()->flash('toaster_sticky_' . $i, self::castToString($sticky));
                break;
            }
        }
    }

    public static function info($message, $sticky = 'true')
    {
        for ($i = 0; $i <= 10; $i++) {
            if (!session()->has('toaster_message_' . $i)) {
                session()->flash('toaster_title_' . $i, 'Info');
                session()->flash('toaster_icon_' . $i, 'info');
                session()->flash('toaster_message_' . $i, $message);
                session()->flash('toaster_sticky_' . $i, self::castToString($sticky));
                break;
            }
        }
    }

    public static function error($message, $sticky = 'true')
    {
        for ($i = 0; $i <= 10; $i++) {
            if (!session()->has('toaster_message_' . $i)) {
                session()->flash('toaster_title_' . $i, 'Error');
                session()->flash('toaster_icon_' . $i, 'error');
                session()->flash('toaster_message_' . $i, $message);
                session()->flash('toaster_sticky_' . $i, self::castToString($sticky));
                break;
            }
        }
    }

    private static function castToString($var)
    {
        if (is_string($var)) {
            return $var;
        }

        if ($var == true) {
            return 'true';
        }

        if ($var == false) {
            return 'false';
        }
    }

    protected static function getFacadeAccessor()
    {
        return 'toaster';
    }
}
