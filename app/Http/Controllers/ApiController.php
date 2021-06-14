<?php

namespace App\Http\Controllers;

use App\Models\Kapal;
use App\Models\Vendor;
use App\Models\Student;
use App\Models\Inventory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ItemMaintenanceActivity;

class ApiController extends Controller
{
    public function getStudent(Request $request)
    {
        $page = \Input::get('page');
        $resultCount = 100;

        $offset = ($page - 1) * $resultCount;
        $search = \Input::get('search');

        $vendor = Student::whereRaw(\DB::raw("lower(name) like '%".$search."%'"))
            ->orderBy('name')
            ->skip($offset)
            ->take($resultCount)
            ->get(['id', \DB::raw("CONCAT(identity_number, ' - ', name) as text")]);
        $count = Student::count();
        $endCount = $offset + $resultCount;
        $morePages = $endCount > $count;

        $results = [
            "results" => $vendor,
            "pagination" => [
                "more" => $morePages
            ]
        ];
        return response()->json($results);
    }
    
}
