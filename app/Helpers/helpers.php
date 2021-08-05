<?php

use App\Models\Setting;
use App\Models\Kategori;
use App\Models\LoadingPln;
use App\Helpers\DateHelper;
use App\Models\LoadingApms;
use App\Helpers\AccessHelper;
use App\Helpers\NumberHelper;
use App\Helpers\ToasterHelper;
use App\Helpers\ApprovalHelper;
use App\Models\NomerBillOfLading;

include_once "external.php";

/**
 * Access Helper
 */
if (! function_exists('access_is_allowed')) {
    function access_is_allowed($permission_slug)
    {
        return AccessHelper::isAllowed($permission_slug);
    }
}

if (! function_exists('access_is_allowed_to_view')) {
    function access_is_allowed_to_view($permission_slug)
    {
        return AccessHelper::isAllowedToView($permission_slug);
    }
}

/**
 * toaster Helper global function
 */

if (! function_exists('toaster_set')) {
    /**
     * @param $title
     * @param $message
     * @param string $sticky
     * @return mixed
     */
    function toaster_set($title, $message, $sticky = 'false')
    {
        return ToasterHelper::set($title, $message, $sticky);
    }
}

if (! function_exists('toaster_success')) {
    /**
     * @param $message
     * @param string $sticky
     * @return mixed
     */
    function toaster_success($message, $sticky = 'false')
    {
        return ToasterHelper::success($message, $sticky);
    }
}

if (! function_exists('toaster_info')) {
    /**
     * @param $message
     * @param string $sticky
     * @return mixed
     */
    function toaster_info($message, $sticky = 'false')
    {
        return ToasterHelper::info($message, $sticky);
    }
}

if (! function_exists('toaster_error')) {
    /**
     * @param $message
     * @param string $sticky
     * @return mixed
     */
    function toaster_error($message, $sticky = 'false')
    {
        return ToasterHelper::error($message, $sticky);
    }
}


/**
 * Permission Helper global function
 */

if (! function_exists('permission_get_by_type')) {
    /**
     * @param $permission_type
     */
    function permission_get_by_type($permission_type)
    {
        return PermissionHelper::getPermissionByType($permission_type);
    }
}

if (! function_exists('permission_check')) {
    /**
     * @param $role_id
     * @param $permission_id
     * @return bool
     */
    function permission_check($role_id, $permission_id)
    {
        return PermissionHelper::check($role_id, $permission_id);
    }
}


/**
 * Form
 */
if (! function_exists('label')) {
    /**
     * @param $role_id
     * @param $permission_id
     * @return bool
     */
    function label($idn, $eng)
    {
        return ucwords($idn).' <small>('.ucwords($eng).')</small>';
    }
}

/**
 * Camera
 */

if (! function_exists('open_camera')) {
    /**
     * @param $url
     * @param $img target callback
     * @param $input link callback
     * @return bool
     */
    function open_camera($img_callback, $input_callback)
    {
        $url = url('camera');
        return '<button type="button" class="btn btn-warning btn-icon-anim btn-square btn-sm" data-toggle="modal" data-target=".camera-modal" onclick="openCamera(\''.$url.'\', \''.$img_callback.'\', \''.$input_callback.'\')"><i class="fa fa-camera"></i></button>';
    }


    /**
     * Approval
     */
    if (! function_exists('status_approval')) {
        /**
         * @param $code
         * @return string
         */
        function status_approval($code, $from=null)
        {
            return ApprovalHelper::checkStatus($code, $from);
        }
    }

    if (! function_exists('list_status_approval')) {
        /**
         * @return array
         */
        function list_status_approval()
        {
            return ApprovalHelper::listStatusApproval();
        }
    }

    if (! function_exists('user_approval')) {
        /**
         * @param $user_id
         * @return array
         */
        function user_approval($user_id)
        {
            return ApprovalHelper::user($user_id);
        }
    }


    /**
     * Setting
     */
    if (! function_exists('setting')) {
        /**
         * @param $key
         * @return string
         */
        function setting($key)
        {
            return Setting::getValue($key);
        }
    }
}
 

/**
 * Number Helper
 */

if (! function_exists('format_db')) {
    /**
     * @param $value
     * @return string
     */
    function format_db($value)
    {
        return NumberHelper::formatDB($value);
    }
}

 if (! function_exists('format_price')) {
     /**
      * @param $value
      * @param $length
      * @return string
      */
     function format_price($value, $length = 3)
     {
         return NumberHelper::formatPrice($value, $length);
     }
 }

if (! function_exists('format_quantity')) {
    /**
     * @param $value
     * @param $length
     * @return string
     */
    function format_quantity($value, $length = 0)
    {
        return NumberHelper::formatQuantity($value, $length);
    }
}

/**
 * Date Helper
 */
if (! function_exists('date_format_view')) {
    /**
     * @param $date
     * @param $time boolean
     * @return string
     */
    function date_format_view($date, $time = false)
    {
        return DateHelper::formatView($date, $time);
    }
}

/**
 * Render Form Btn Approve and btn Reject by email
 */
if (! function_exists('btn_approve_reject_email')) {
    /**
     * @param $date
     * @param $time boolean
     * @return string
     */
    function btn_approve_reject_email($class, $id, $approval_at, $status_approval)
    {
        $param = get_class($class).'.'.$id.'.'.$approval_at.'.'.$status_approval;
        $encrypted = Illuminate\Support\Facades\Crypt::encryptString($param);
        return '
        <a class="btn confirm" href="'.url("/").'/email-approve/2/'.$encrypted.'">Setujui</a>
        <a class="btn reject" href="'.url("/").'/email-approve/3/'.$encrypted.'">Tolak</a>';
    }
}

/**
 * Jabatan pemberi order
 */
if (! function_exists('jabatan')) {
    /**
     * @param $date
     * @param $time boolean
     * @return string
     */
    function jabatan($nama)
    {
        $default = 'Sr Supervisor Receiving, Storage Distribution';
        $kategori =  Kategori::where('nama', $nama)->first();
        
        if (! $kategori) {
            return $default;
        }
        if (! $kategori->option) {
            return $default;
        }
        return $kategori->option;
    }
}

/**
 * Jabatan pemberi order
 */
if (! function_exists('jabatan')) {
    /**
     * @param $date
     * @param $time boolean
     * @return string
     */
    function jabatan($nama)
    {
        $default = 'Sr Supervisor Receiving, Storage Distribution';
        $kategori =  Kategori::where('nama', $nama)->first();
        
        if (! $kategori) {
            return $default;
        }
        if (! $kategori->option) {
            return $default;
        }
        return $kategori->option;
    }
}

/** generate bill of lading */
if (! function_exists('next_bill_of_lading')) {
    
    function next_bill_of_lading()
    {
        return NomerBillOfLading::next();
    }
}

/** generate token */
if (! function_exists('create_token')) {
    function enc($group_id, $topic_id, $student_id)
    {
        return encrypt($group_id.'.'.$topic_id .'.'. $student_id);
    }
}