@extends('layouts.email')

@section('css')
    <style>
    
    .btn {
        padding: 16px 25px;
        color: #fff;
        text-decoration: none;
        display: inline-block;
        border-radius: 2px;
        border: none
    }
    
    .confirm {
        background: #42b549;
    }
    </style>
@endsection

@section('content')
    <img class="brand-img" style="height:30px; width: auto; border: 1px solid #a29d9d; padding: 5px" src="{{asset('dist/img/pertamina.png')}}" alt="brand" />
    <p style="font-size:14px; color: #000; float: right; text-align: right">PT. PERTAMINA <br> INTEGRATED TERMINAL TANJUNG WANGI <br></p>
    <div style="clear: both"></div>
    
    {{-- title --}}
    <h3>Pembuatan akun Bunker Fee Anda - DISETUJUI</h3>
    
    {{-- greating --}}
    <p style="font-size:14px;"><b>Halo {{$user->name}}, </b><br>
    Request pembuatan Akun Bunker Fee Anda statusnya : <b> {{$user->status_approval == 1 ? 'DI SETUJUI' : 'DI TOLAK'}} </b>. Silahkan menghubungi operator jika ada yang perlu ditanyakan. <br> Terimakasih</p>
@endsection