@extends('layouts.app')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'Pengaturan '. $setting->name,
        'breadcrumbs' => [
            0 => [
                'link' => url('dashboard'),
                'label' => 'dashboard'
            ],
            1 => [
                'link' => '#',
                'label' => 'Ubah Pengaturan'
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
                            <form method="post" action="{{url('setting/'.$setting->id)}}">
                                {!! csrf_field() !!}
                                <input name="_method" type="hidden" value="PUT">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">{{$setting->description}}</label>
                                </div>
                                <div class="form-group">
                                    @if ($setting->input_type == 'time')
                                    <?php 
                                        $date = date('Y-m-d') . ' ' .$setting->value;
                                        $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $date);
                                        $time = $date->format('g:i A');
                                    ?>
                                    <div class='input-group date' id='time'>
                                        <input type='text' class="form-control" name="value" value="{{$time}}" />
                                        <span class="input-group-addon">
                                            <span class="fa fa-clock-o"></span>
                                        </span>
                                    </div>
                                    @endif

                                    @if ($setting->input_type == 'user')
                                    <div class="form-group">
                                        <select class="form-control" id="select" name="value">
                                            <option disabled>--Select one--</option>
                                            @foreach($users as $user)
                                            <option value="{{$user->id}}" @if($user->id == $setting->value) selected  @endif>{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif
                                </div>
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


@section('scripts')
<script>
    initTime('#time');
    $('#select').select2();
</script>
@stop