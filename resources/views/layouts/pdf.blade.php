<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <style>
    body {
        font-family: DejaVu Sans;
    }
    table {
        /* font-family: "Trebuchet MS", Arial, Helvetica, sans-serif; */
        border-collapse: collapse;
        width: 100%;
        font-size: 12px;
    }

    .table td, th {
        border: 1px solid #ddd;
        padding: 6px;
    }
    
    .td-no-border {
        border: none !important;
    }

    table.table-no-border, table.table-no-border td {
        border: none !important;
        padding: 6px;
    }
    .fs-12 { font-size: 12px; background: #eee; color: black;}
    .page-break { page-break-after: always;}
    </style>
    @yield('css')
</head>
<body>
    @yield('content')
</body>
</html>