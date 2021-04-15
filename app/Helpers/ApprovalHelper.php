<?php

namespace App\Helpers;

use App\User;
use Illuminate\Support\Facades\Facade;

class ApprovalHelper extends Facade
{
    /** Get User */
    public static function user($user_id)
    {
        $user = User::find($user_id);
        return $user ? $user->name : '-';
    }

    /** Check status approval in view */
    public static function checkStatus($code, $from=null)
    {
        if ($code == 0) {
            if ($from == 'excel') return 'Belum mengajukan';

            return '<span class="label label-default">Belum mengajukan</span>';
        }

        if ($code == 1) {
            if ($from == 'excel') return 'Menunggu';

            return '<span class="label label-warning">Menunggu</span>';
        }

        if ($code == 2) {
            if ($from == 'excel') return 'Sudah disetujui';

            return '<span class="label label-info">Sudah disetujui</span>';
        }

        if ($code == 3) {
            if ($from == 'excel') return 'Ditolak';

            return '<span class="label label-danger">Ditolak</span>';
        }
    }

    /** Status request approval */
    public static function listStatusApproval()
    {
        return [
            0 => 'Belum mengajukan',
            1 => 'Menunggu',
            2 => 'Sudah diapprove',
            3 => 'Ditolak',
        ];
    }
}