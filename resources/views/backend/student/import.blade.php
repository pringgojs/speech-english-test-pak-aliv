@extends('layouts.app')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'Import Student Data',
        'breadcrumbs' => [
            0 => [
                'link' => url('/'),
                'label' => 'dashboard'
            ],
            1 => [
                'link' => url('student'),
                'label' => 'Student'
            ],
            2 => [
                'link' => '#',
                'label' => 'Import Student Data'
            ],
        ]
    ])
    
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Petunjuk Import data</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <p>1. Unduh Template excel disini. <a href="{{url('student/import-download-template')}}" class="text-info"><i class="fa fa-download"></i> Unduh template</a></p>
                        <p>2. Untuk kolom header di template excel, jangan dirubah.</p>
                        <p>3. Unggah kembali file excel tersebut</p>
                        <p>4. Anda akan melihat data hasil diimport pada tabel disamping</p>
                        <p>5. Klik tombol <b>Simpan</b> untuk menyimpan hasil import Anda</p>
                    </div>
                </div>
            </div>
        {{-- </div> --}}

        {{-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> --}}
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">form unggah</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{url('student/import')}}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="control-label mb-10 col-sm-2" for="email_hr">File</label>
                                    <div class="col-sm-10">
                                        <input type="file" required class="form-control" id="file" name="file" placeholder="pilih sebuah file excel">
                                        <span class="help-block mt-10 mb-0"><small>File yang diunggah harus file excel</small></span>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">unggah</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($list_data_import)
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Data Import data Berhasil
                        </h6>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-sm btn-default " href="{{url('student/import-store-model')}}">Save to Database</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-hover display  pb-30">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Identity Number</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($list_data_import as $row => $import)
                                        <tr>
                                            <td>{{$row + 1}}</td>
                                            <td>{{$import['name']}}</td>
                                            <td>{{$import['identity_number']}}</td>
                                            <td>{{$import['address']}}</td>
                                            <td>{{$import['phone']}}</td>
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
        @endif
    </div>

@stop


@section('scripts')
    <script>
    </script>
@endsection