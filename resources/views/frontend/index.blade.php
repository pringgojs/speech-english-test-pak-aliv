@extends('layouts.app-front')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'Dashboard',
        'breadcrumbs' => [
            0 => [
                'link' => '#',
                'label' => ''
            ]
        ]
    ])
    
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <article class="col-item">
                            <div class="photo">
                                <div class="options">
                                    <a href="add-products.html" class="font-18 txt-grey mr-10 pull-left"><i class="zmdi zmdi-edit"></i></a>
                                    <a href="javascript:void(0);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
                                </div>
                                
                                <a href="javascript:void(0);"> <img src="{{asset('microphone.png')}}" class="img-responsive" alt="Product Image"> </a>
                            </div>
                            <div class="info">
                                <h6>Circle chair</h6>
                                <div class="product-rating inline-block">
                                    <a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star mr-0"></a><a href="javascript:void(0);" class="font-12 txt-orange zmdi zmdi-star-outline mr-0"></a>
                                </div>
                                <span class="head-font block txt-orange-light-1 font-16">$150</span>
                            </div>
                        </article>
                    </div>
                </div>	
            </div>	
        </div>
    </div>

@stop