@extends('layouts.app')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'Topic',
        'breadcrumbs' => [
            0 => [
                'link' => url('/'),
                'label' => 'dashboard'
            ],
            1 => [
                'link' => url('topic'),
                'label' => 'Topic'
            ],
            2 => [
                'link' => '#',
                'label' => $topic->id ? 'Update': 'Create new'
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
                            <form method="post" action="{{url('master/topic')}}" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <input type="hidden" name="id" value="{{$topic->id}}">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">Name*</label>
                                    <input type="text" name="name" value="{{$topic->name}}" class="form-control" placeholder="" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">Trial*</label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="radio radio-info">
                                                <input type="radio" name="trial" id="unlimited" value="0" @if($topic->max_trial == 0) checked @endif>
                                                <label for="unlimited">
                                                    Unlimited
                                                </label>
                                            </div>

                                            <div class="radio radio-info">
                                                <input type="radio" name="trial" id="trial" value="1" @if($topic->max_trial > 0) checked @endif>
                                                <label for="trial">
                                                    Trial
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row col-max-trial @if($topic->max_trial == 0) hidden @endif">
                                        <div class="col-md-3">
                                            <input type="number" min="1" name="max_trial" id="max_trial" value="{{$topic->max_trial}}" class="form-control" placeholder="max trial" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group ">
                                    <label class="control-label mb-10">Cover (optional)</label>
                                    <input type='file' name="file" accept="png,jpeg,jpg" id="file" class="form-control" />
                                    @if ($topic->image)
                                        <img src="{{asset($topic->image)}}" width="150px" height="auto" alt="">
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
    initFormatNumber();

    $('input:radio').click(function() {
        if ($(this).val() === '0') {
            $('.col-max-trial').addClass('hidden');
            $('#max_trial').prop('disabled', true);

        } else if ($(this).val() === '1') {
            $('.col-max-trial').removeClass('hidden');
            $('#max_trial').prop('disabled', false);
        } 
    });

    </script>
@endsection