@extends('layouts.app')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'Group',
        'breadcrumbs' => [
            0 => [
                'link' => url('/'),
                'label' => 'dashboard'
            ],
            1 => [
                'link' => url('group'),
                'label' => 'Group'
            ],
            2 => [
                'link' => '#',
                'label' => $group->id ? 'Update': 'Create new'
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
                        @include('backend.group._wizard', ['from' => 'step-1'])
                        <br><br>
                        <div class="form-wrap">
                            <form method="post" action="{{url('group')}}">
                                {!! csrf_field() !!}
                                <input type="hidden" name="id" value="{{$group->id}}">
                                <div class="form-group">
                                    <input type="text" name="name" value="{{$group->name}}" class="form-control" placeholder="Group Name" required>
                                </div>
                                <br>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">submit and next step</span></button>
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
    </script>
@endsection