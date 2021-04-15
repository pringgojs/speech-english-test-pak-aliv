@extends('layouts.app')

@section('content')
    <!-- Title -->
    <?php 
    
    ?>
    @include('backend._bread-crumb', [
        'title' => 'Kategori '.jenis_kategori(\Input::get('tipe')),
        'breadcrumbs' => [
            0 => [
                'link' => url('/'),
                'label' => 'dashboard'
            ],
            1 => [
                'link' => url('master'),
                'label' => 'Master Data'
            ],
            2 => [
                'link' => '#',
                'label' => 'Kategori'
            ],
        ]
    ])
    
    <!-- /Title -->
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        @if(access_is_allowed_to_view('create.master.kategori'))
                        <div class="dt-buttons">
                            <a class="dt-button buttons-copy buttons-html5" tabindex="0" aria-controls="example" href="{{url('master/kategori/create?tipe='.\Input::get("tipe"))}}"><i class="fa fa-plus"></i> <span>Buat baru</span></a>
                        </div>
                        @endif
                        <h6 class="panel-title txt-dark"></h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-hover display  pb-30" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Tipe</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $row => $kategori)
                                        <tr id="tr-{{$kategori->id}}">
                                            <td>{{$row + 1}}</td>
                                            <td>
                                                {{$kategori->nama}} <br>
                                                @if($kategori->tipe == 'pemberi_order')
                                                <b style="font-weight:bold">{{$kategori->option}}</b>
                                                @endif
                                            </td>
                                            <td>{{jenis_kategori($kategori->tipe)}}</td>
                                            <td>
                                                @if(access_is_allowed_to_view('update.master.kategori'))
                                                <a href="{{url('master/kategori/'.$kategori->id.'/edit')}}" data-toggle="tooltip" data-original-title="Edit">
                                                    <button class="btn btn-default btn-icon-anim btn-square btn-sm"><i class="fa fa-pencil"></i></button>
                                                </a>
                                                @endif
                                                @if(access_is_allowed_to_view('delete.master.kategori'))
                                                <a onclick="secureDelete('{{url('master/kategori/'.$kategori->id)}}', '#tr-{{$kategori->id}}')" onclick="document.getElementById('form-delete-{{$kategori->id}}').submit();"  data-toggle="tooltip" data-original-title="Close">
                                                    <button class="btn btn-info btn-icon-anim btn-square  btn-sm"><i class="icon-trash"></i></button>                                                    
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>	
        </div>
    </div>
    <!-- /Row -->
@stop