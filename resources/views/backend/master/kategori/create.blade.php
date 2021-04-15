@extends('layouts.app')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'Kategori ' .jenis_kategori(\Input::get('tipe')),
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
                            <form method="post" action="{{url('master/kategori')}}">
                                <input type="hidden" readonly class="form-control" value="{{\Input::get('tipe')}}" name="tipe" required>
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">Nama {{jenis_kategori(\Input::get('tipe'))}}</label>
                                    <input type="text" class="form-control" value="" name="nama" required>
                                </div>
                                @if(\Input::get('tipe') == 'pemberi_order')
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">Jabatan</label>
                                    <input type="text" class="form-control" value="" name="option" required>
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