<?php

namespace App\Helpers;

use App\Helpers;
use Carbon\CarbonPeriod;

class DateHelper
{

    /**
     * convert date input to database format
     * @param  datetime $date
     * @param  string $hour ='original'
     * @return datetime
     */
    public static function formatDB($date, $hour = 'original')
    {
        // select format from database
        $date_input = 'm/d/Y';
        $array = [];
        // convert
        if ($date_input == 'm-d-y') {
            $array = explode('-', $date);
        } elseif ($date_input == 'm-d-Y') {
            $array = explode('-', $date);
        } elseif ($date_input == 'm/d/y') {
            $array = explode('/', $date);
        } elseif ($date_input == 'm/d/Y') {
            $array = explode('/', $date);
        } 
        $date = $array[2] . '-' . $array[0] . '-' . $array[1];
        // return database format
        if ($hour == 'start') {
            return date('Y-m-d 00:00:00', strtotime($date));
        } elseif ($hour == 'end') {
            return date('Y-m-d 23:59:59', strtotime($date));
        } elseif ($hour != 'original') {
            return date('Y-m-d ' . $hour, strtotime($date));
        } elseif ($hour == false) {
            return date('Y-m-d');
        }

        return date('Y-m-d H:i:s', strtotime($date));
    }

    /**
     * display date for view
     * @param  datetime $date
     * @param  boolean $time =false [display time]
     * @return datetime
     */
    public static function formatView($date, $time = false)
    {
        // select format from database
        $date_input = 'd M Y';
        if ($time === true) {
            return date($date_input . ' H:i', strtotime($date));
        }

        return date($date_input, strtotime($date));
    }

    /**
     * default date for input mask
     * @return string [masking date input]
     */
    public static function formatMasking()
    {
        // select format from database
        $date_input = 'Y-m-d';

        // return format
        if ($date_input == 'd-m-y') {
            return 'dd-mm-yy';
        } elseif ($date_input == 'd-m-Y') {
            return 'dd-mm-yyyy';
        } elseif ($date_input == 'd/m/y') {
            return 'dd/mm/yy';
        } elseif ($date_input == 'd/m/Y') {
            return 'dd/mm/yyyy';
        }
    }

    /**
     * default format value for edit form
     * @return string [date() parameter format]
     */
    public static function formatGet()
    {
        // return Setting::where('name', '=', 'date-input')->first()->value;
    }

    public static function getAllDaysByMonth($month, $year)
    {
        $start_date = "01-".$month."-".$year;
        $start_time = strtotime($start_date);

        $end_time = strtotime("+1 month", $start_time);

        for ($i=$start_time; $i<$end_time; $i+=86400) {
            $list[] = [
                'date' => date('Y-m-d', $i),
                'day' => date('D', $i)
            ];
        }

        return $list;
    }

    public static function getDatesFromRange($start, $end)
    {
        $period = CarbonPeriod::create($start, $end);
        $dates = [];
        foreach ($period as $date) {
            array_push($dates, $date->format('Y-m-d'));
        }

        return $dates;
    }

    public static function checkInRange($start_date, $end_date, $date_from_user)
    {
        // Convert to timestamp
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($date_from_user);

        // Check that user date is between start & end
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
    }

    /**
     * Get all months
     */
    public static function getAllMonths()
    {
        return [
            '01' => 'Januari',  
            '02' => 'Pebruari',  
            '03' => 'Maret',  
            '04' => 'April',  
            '05' => 'Mei',  
            '06' => 'Juni',  
            '07' => 'Juli',  
            '08' => 'Agustus',
            '09' => 'September',  
            '10' => 'Oktober',  
            '11' => 'Nopember',  
            '12' => 'Desember'
        ];
    }
}
