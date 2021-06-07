@extends('layouts.app')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'Student',
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
                'label' => $student->id ? 'Update': 'Create new'
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
                            <form method="post" action="{{url('student')}}">
                                {!! csrf_field() !!}
                                <input type="hidden" name="id" value="{{$student->id}}">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">Name*</label>
                                    <input type="text" name="name" value="{{$student->name}}" class="form-control" placeholder="" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">Identity Number*</label>
                                    <input type="text" name="identity_number" value="{{$student->identity_number}}" class="form-control" placeholder="" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">Phone</label>
                                    <input type="text" name="phone" value="{{$student->phone}}" class="form-control" placeholder="" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">Address</label>
                                    <textarea name="address" class="form-control" id="" cols="30" rows="4">{{$student->address}}</textarea>
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
    </script>
@endsection