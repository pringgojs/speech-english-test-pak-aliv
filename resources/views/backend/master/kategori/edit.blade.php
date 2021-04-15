@extends('layouts.app')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'Kategori',
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
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form method="post" action="{{url('master/kategori/'.$kategori->id)}}">
                                {!! csrf_field() !!}
                                <input name="_method" type="hidden" value="PUT">
                                <input type="hidden" readonly class="form-control" value="{{$kategori->tipe}}" name="tipe" required>
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">Nama</label>
                                    <input type="text" class="form-control" value="{{$kategori->nama}}" name="nama" required>
                                </div>
                                @if($kategori->tipe == 'pemberi_order')
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">Jabatan</label>
                                    <input type="text" class="form-control" value="{{$kategori->option}}" name="option" required>
                                </div>
                                @endif
                                
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">submit</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>	
        </div>
    </div>
    <!-- /Row -->
@stop