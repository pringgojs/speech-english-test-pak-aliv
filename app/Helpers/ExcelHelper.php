<?php

namespace App\Helpers;

class ExcelHelper
{
    public static function excel($file_name, $data, $header) 
    {
        \Excel::create($file_name, function ($excel) use ($data, $header)  {
            # Sheet Tim
            $excel->sheet($header, function ($sheet) use ($data, $header)  {
                $sheet->setWidth(array(
                    'A' => 25,
                    'B' => 25
                ));

                // MERGER COLUMN
                $sheet->mergeCells('A1:G1', 'center');
                $sheet->cell('A1:J2', function ($cell) {
                    // Set font
                    $cell->setFont(array(
                        'family'     => 'Times New Roman',
                        'size'       => '12',
                    ));
                });
                $sheet->cell('A1', function ($cell) use ($header) {
                    $cell->setValue(strtoupper($header));
                });
                
                $sheet->fromArray($data, null, 'A2', false, false);
            });

        })->export('xls');
    }

    public static function multipleSheet($file_name, $data = [])
    {
        \Excel::create($file_name, function ($excel) use ($data) {
            for ($i=0; $i < count($data); $i++) { 
                $sheet_name = $data[$i]['sheet_name'];
                $sheet_data = $data[$i]['sheet_data'];
                $excel->sheet($sheet_name, function ($sheet) use ($sheet_data) {
                    $sheet->fromArray($sheet_data, null, 'A1', false, false);
                });
            }
        })->export('xls');
    }

    public static function templateImport($file_name, $data, $sheet_name) 
    {
        \Excel::create($file_name, function ($excel) use ($data, $sheet_name)  {
            $excel->sheet($sheet_name, function ($sheet) use ($data)  {
                $sheet->fromArray($data, null, 'A1', false, false);
            });

        })->export('xls');
    }
    
}
