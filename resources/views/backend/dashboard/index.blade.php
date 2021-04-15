@extends('layouts.app')
@section('content')
<!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'Buat Pelaksanan Pelayanan Baru',
        'breadcrumbs' => [
            0 => [
                'link' => url('/'),
                'label' => 'dashboard'
            ]
        ]
    ])
    @include('backend.dashboard._welcome')
	@include('backend.dashboard._count')
@stop

@section('scripts')
	
@stop