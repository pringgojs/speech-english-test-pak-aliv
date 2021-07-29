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
        <div class="col-md-8">
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="sm-data-box">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                                <span class="txt-dark block counter"><span class="counter-anim">914,001</span></span>
                                                <span class="capitalize-font block">total kuis selesai</span>
                                            </div>
                                            <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                                <i class="icon-check data-right-rep-icon"></i>
                                            </div>
                                        </div>
                                        <div class="progress-anim">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-orange
                                                wow animated progress-animated" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-6 col-xs-12">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="sm-data-box">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                                <span class="txt-dark block counter"><span class="counter-anim">46.41</span>%</span>
                                                <span class="capitalize-font block">Total kuis belum selesai</span>
                                            </div>
                                            <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                                <i class="icon-close  data-right-rep-icon"></i>
                                            </div>
                                        </div>
                                        <div class="progress-anim">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-orange
                                                wow animated progress-animated" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- daftar kuis --}}
                <div class="col-sm-12 col-xs-12">
                    <div class="panel panel-default border-panel card-view">
                        <div class="panel-heading">
                            <div class="pull-left auto-width">
                                <h6 class="panel-title txt-dark">Daftar Kuis</h6>
                            </div>
                            
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0 row">
                                <div class="tab-content" id="myTabContent_9">
                                    <div id="home_9" class="tab-pane fade active in" role="tabpanel">
                                        <div class="table-wrap">
                                            <div class="table-responsive">
                                              <table class="table table-hover mt-15 mb-0">
                                                <thead>
                                                  <tr>
                                                    <th>#</th>
                                                    <th>Topic</th>
                                                    <th>Status</th>
                                                    <th>Score</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <tr>
                                                    <td>1</td>
                                                    <td>Milk Powder</td>
                                                    <td>Done</td>
                                                    <td>50</td>
                                                  </tr>

                                                  <tr>
                                                    <td>2</td>
                                                    <td>Milk Powder</td>
                                                    <td>Done</td>
                                                    <td>45</td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="profile_9" class="tab-pane fade" role="tabpanel">
                                        <div class="table-wrap">
                                            <div class="table-responsive">
                                              <table class="table table-hover mb-0">
                                                <thead>
                                                  <tr>
                                                    <th>#</th>
                                                    <th>Products</th>
                                                    <th>Popularity</th>
                                                    <th>Sales</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <tr>
                                                    <td>1</td>
                                                    <td>Milk Powder</td>
                                                    <td><span class="peity-line" data-width="90" data-peity="{ &quot;fill&quot;: [&quot;transparent&quot;], &quot;stroke&quot;:[&quot;#ff6028&quot;]}" data-height="40" style="display: none;">4,-4,-2,-4,5,-4,3,-1,5,-1</span><svg class="peity" height="40" width="90"><polygon fill="transparent" points="0 22.166666666666668 0 4.833333333333336 10 39.5 20 30.833333333333336 30 39.5 40 0.5 50 39.5 60 9.166666666666668 70 26.5 80 0.5 90 26.5 90 22.166666666666668"></polygon><polyline fill="none" points="0 4.833333333333336 10 39.5 20 30.833333333333336 30 39.5 40 0.5 50 39.5 60 9.166666666666668 70 26.5 80 0.5 90 26.5" stroke="#ff6028" stroke-width="1" stroke-linecap="square"></polyline></svg> </td>
                                                    <td><span class="text-success text-semibold"><i class="fa fa-level-up" aria-hidden="true"></i> 18.76%</span> </td>
                                                  </tr>
                                                  <tr>
                                                    <td>2</td>
                                                    <td>Air Conditioner</td>
                                                    <td><span class="peity-line" data-width="90" data-peity="{ &quot;fill&quot;: [&quot;transparent&quot;], &quot;stroke&quot;:[&quot;#ff6028&quot;]}" data-height="40" style="display: none;">0,-1,1,-4,-3,1,-2,-3,2,-2</span><svg class="peity" height="40" width="90"><polygon fill="transparent" points="0 13.5 0 13.5 10 20 20 7 30 39.5 40 33 50 7 60 26.5 70 33 80 0.5 90 26.5 90 13.5"></polygon><polyline fill="none" points="0 13.5 10 20 20 7 30 39.5 40 33 50 7 60 26.5 70 33 80 0.5 90 26.5" stroke="#ff6028" stroke-width="1" stroke-linecap="square"></polyline></svg> </td>
                                                    <td><span class="text-danger text-semibold"><i class="fa fa-level-down" aria-hidden="true"></i> 48.55%</span> </td>
                                                  </tr>
                                                  <tr>
                                                    <td>3</td>
                                                    <td>RC Cars</td>
                                                    <td><span class="peity-line" data-width="90" data-peity="{ &quot;fill&quot;: [&quot;transparent&quot;], &quot;stroke&quot;:[&quot;#ff6028&quot;]}" data-height="40" style="display: none;">0,9,6,1,2,4,6,3,7,1</span><svg class="peity" height="40" width="90"><polygon fill="transparent" points="0 39.5 0 39.5 10 0.5 20 13.5 30 35.166666666666664 40 30.833333333333336 50 22.166666666666668 60 13.5 70 26.5 80 9.166666666666668 90 35.166666666666664 90 39.5"></polygon><polyline fill="none" points="0 39.5 10 0.5 20 13.5 30 35.166666666666664 40 30.833333333333336 50 22.166666666666668 60 13.5 70 26.5 80 9.166666666666668 90 35.166666666666664" stroke="#ff6028" stroke-width="1" stroke-linecap="square"></polyline></svg> </td>
                                                    <td><span class="text-success text-semibold"><i class="fa fa-level-up" aria-hidden="true"></i> 8.56%</span> </td>
                                                  </tr>
                                                  <tr>
                                                    <td>4</td>
                                                    <td>Down Coat</td>
                                                    <td><span class="peity-line" data-width="90" data-peity="{ &quot;fill&quot;: [&quot;transparent&quot;], &quot;stroke&quot;:[&quot;#ff6028&quot;]}" data-height="40" style="display: none;">7,5,6,4,5,4,6,5,4,2</span><svg class="peity" height="40" width="90"><polygon fill="transparent" points="0 39.5 0 0.5 10 11.642857142857142 20 6.0714285714285765 30 17.214285714285715 40 11.642857142857142 50 17.214285714285715 60 6.0714285714285765 70 11.642857142857142 80 17.214285714285715 90 28.357142857142858 90 39.5"></polygon><polyline fill="none" points="0 0.5 10 11.642857142857142 20 6.0714285714285765 30 17.214285714285715 40 11.642857142857142 50 17.214285714285715 60 6.0714285714285765 70 11.642857142857142 80 17.214285714285715 90 28.357142857142858" stroke="#ff6028" stroke-width="1" stroke-linecap="square"></polyline></svg> </td>
                                                    <td><span class="text-success text-semibold"><i class="fa fa-level-up" aria-hidden="true"></i> 98.76%</span> </td>
                                                  </tr>
                                                  <tr>
                                                    <td>5</td>
                                                    <td>Xyz Byke</td>
                                                    <td><span class="peity-line" data-width="90" data-peity="{ &quot;fill&quot;: [&quot;transparent&quot;], &quot;stroke&quot;:[&quot;#ff6028&quot;]}" data-height="40" style="display: none;">0,3,6,4,5,4,7,3,4,2</span><svg class="peity" height="40" width="90"><polygon fill="transparent" points="0 39.5 0 39.5 10 22.78571428571429 20 6.0714285714285765 30 17.214285714285715 40 11.642857142857142 50 17.214285714285715 60 0.5 70 22.78571428571429 80 17.214285714285715 90 28.357142857142858 90 39.5"></polygon><polyline fill="none" points="0 39.5 10 22.78571428571429 20 6.0714285714285765 30 17.214285714285715 40 11.642857142857142 50 17.214285714285715 60 0.5 70 22.78571428571429 80 17.214285714285715 90 28.357142857142858" stroke="#ff6028" stroke-width="1" stroke-linecap="square"></polyline></svg> </td>
                                                    <td><span class="text-success text-semibold"><i class="fa fa-level-up" aria-hidden="true"></i> 12.76%</span> </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
@stop