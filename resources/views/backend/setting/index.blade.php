@extends('layouts.app')

@section('styles')
<style>
    @media (max-width: 1189px) {
        tbody tr td {
            word-wrap: break-word !important;
            vertical-align: top !important;
            width:100px;
        }
    }

    table {
        word-break: break-word !important;
        vertical-align: top;
    }
</style>
@stop
@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'Pengaturan',
        'breadcrumbs' => [
            0 => [
                'link' => url('dashboard'),
                'label' => 'dashboard'
            ],
            1 => [
                'link' => url('setting'),
                'label' => 'Pengaturan'
            ]
        ]
    ])
    
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-hover display  pb-30" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Deskripsi</th>
                                            <th>Isi</th>
                                            <th>Tipe</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($settings as $row => $setting)
                                        <tr>
                                            <td>{{$row + 1}}</td>
                                            <td>{{$setting->name}}</td>
                                            <td>{{$setting->description}}</td>
                                            <td>@if($setting->input_type == 'user') {{ \App\User::find($setting->value) ? \App\User::find($setting->value)->name : '-' }} @else {{$setting->value}} @endif</td>
                                            <td>{{$setting->input_type}}</td>
                                            <td>
                                                @if(access_is_allowed_to_view('update.setting'))
                                                    <a href="{{url('setting/'.$setting->id.'/edit')}}" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
        </div>
    </div>
    <!-- /Row -->
@stop

@section('scripts')
<script>
    initDatatable('#datatable');
</script>
@stop