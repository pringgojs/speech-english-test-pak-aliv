@extends('layouts.app-front')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'Pegawai',
        'breadcrumbs' => [
            0 => [
                'link' => url('dashboard'),
                'label' => 'dashboard'
            ],
            1 => [
                'link' => url('employee'),
                'label' => 'Pegawai'
            ]
        ]
    ])
    
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <div class="dt-buttons">
                            <a class="dt-button buttons-copy buttons-html5" tabindex="0" aria-controls="example" href="{{url('employee/create')}}"><i class="fa fa-plus"></i> <span>Buat baru</span></a>
                            <a class="dt-button buttons-copy buttons-html5" tabindex="0" aria-controls="example" href="{{url('employee/import')}}"><i class="fa fa-upload"></i> <span>Import From Excel</span></a>
                        </div>
                        <h6 class="panel-title txt-dark"></h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <form action="{{url('employee')}}">
                                    <div class="form-group">
                                        <?php $status = \Input::get('status');?>
                                        <label class="control-label mb-10 text-left">Cari. nama / nip / posisi / bagian</label>
                                        <input type="text" class="form-control" name="search" value="{{\Input::get('search')}}" id="">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-3">
                                {{-- filter --}}
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">Filter berdasarkan status</label>
                                    <select name="" id="filter" onchange="filter(this.value)" class="form-control">
                                        <option value="2" @if(\Input::get('status') == 2) selected @endif>Semua</option>
                                        <option value="1" @if(\Input::get('status') == 1) selected @endif>Aktif</option>
                                        <option value="0" @if(\Input::get('status') == 0) selected @endif>Non Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-hover display  pb-30" >
                                    <thead>
                                        <tr>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>NIP/NIK</th>
                                            <th>Telepon</th>
                                            <th>Email</th>
                                            <th>Posisi / Jabatan</th>
                                            <th>Bagian</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
        </div>
    </div>
    <!-- /Row -->

    <div class="row">
        <div class="modal fade detail-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg" id="modal-detail">

            </div>
        </div>
    </div>
@stop

@section('scripts')
<script>

    function filter(status) {
        location.href = '{{url("/")}}/employee?status='+status;
    }

    function showDetail(url) {
        $.ajax({
            url: url,
            success: function(result){
                $("#modal-detail").html(result);
            }, error: function(result){
                swal("Failed something went wrong");
            }
        });
    }
</script>
@stop