@extends('layouts.master')
@section('title') لوحة التحكم @endsection
@section('css')
    <link href="{{ URL::asset('libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('common-components.breadcrumb')
         @slot('title') لوحة التحكم   @endslot
         @slot('title_li') مرحبا بك في {{config('app.name', 'Laravel')}} Dashboard   @endslot
     @endcomponent
                    <div class="row">
{{--                        <div class="col-xl-3">--}}

{{--                            @if (in_array('SUPER_ADMIN',auth()->user()->getRoleNames()->toArray()))--}}
{{--                                @component('common-components.dashboard-widget')--}}
{{--                                    @slot('title') الأكاديميات   @endslot--}}
{{--                                    @slot('iconClass') mdi mdi-flip-horizontal  @endslot--}}
{{--                                    @slot('price') {{\App\Models\User::where('type','ACADEMY')->count()}}  @endslot--}}
{{--                                    @slot('percentage') {{round(($new_academies_count/$all_academies_count)*100)}}%   @endslot--}}
{{--                                    @slot('pClass') progress-bar bg-primary   @endslot--}}
{{--                                    @slot('pValue') {{round(($new_academies_count/$all_academies_count)*100)}}   @endslot--}}
{{--                                @endcomponent--}}
{{--                            @else--}}
{{--                                @component('common-components.dashboard-widget')--}}
{{--                                    @slot('title') المدربين  @endslot--}}
{{--                                    @slot('iconClass') mdi mdi-gamepad-square  @endslot--}}
{{--                                    @slot('price') {{\App\Models\User::where('type','COACH')->count()}}  @endslot--}}
{{--                                    @slot('percentage') {{round(($new_coaches_count/$all_coaches_count)*100)}}%   @endslot--}}
{{--                                    @slot('pClass') progress-bar bg-success   @endslot--}}
{{--                                    @slot('pValue') {{round(($new_coaches_count/$all_coaches_count)*100)}}   @endslot--}}
{{--                                @endcomponent--}}
{{--                            @endif--}}
{{--                        </div>--}}
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <div hidden id="data_groups" data-colors="{{$colors}}" data-data="{{$first_chart_data}}" data-terms="{{$terms}}"></div>
                                    <h4 class="card-title mb-4">{{$first_chart_title}}</h4>
                                    <div id="line-chart-group-subscribes" class="apex-charts"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">{{$second_chart_title}}</h4>
                                    <div hidden id="data_profits" data-data="{{$second_chart_data}}"></div>
                                    <div id="column-chart-profits" class="apex-charts"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row">
                        <div class="col-xl-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">{{$third_chart_title}}</h4>
                                    <div hidden id="data_sports" data-data="{{$third_chart_data}}" data-sports="{{$sports_data}}"></div>
                                    <div id="chart-sports" class="apex-charts"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-7">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">{{$fourth_chart_title}}</h4>
                                    <div>
                                        @component('common-components.dashboard-overview')
                                            @slot('mainClass') pb-3 border-bottom  @endslot
                                            @slot('title') اللاعبين  @endslot
                                            @slot('total') {{$analysis_month['all_players_count']}}  @endslot
                                            @slot('percentage'){{$analysis_month['new_players_ratio']}}@endslot
                                            @slot('pClass') progress-bar bg-success  @endslot
                                            @slot('pValue') {{$analysis_month['new_players_count']}}   @endslot
                                        @endcomponent

                                        @component('common-components.dashboard-overview')
                                            @slot('mainClass') pb-3 border-bottom mt-2  @endslot
                                            @slot('title')اشتراكات الجروبات  @endslot
                                            @slot('total') {{$analysis_month['all_group_subscribes_count']}} @endslot
                                            @slot('percentage')  {{$analysis_month['new_group_subscribes_ratio']}}@endslot
                                            @slot('pClass')  progress-bar bg-info  @endslot
                                            @slot('pValue') {{$analysis_month['new_group_subscribes_count']}}  @endslot
                                        @endcomponent

                                        @component('common-components.dashboard-overview')
                                            @slot('mainClass') pb-3 border-bottom mt-2  @endslot
                                            @slot('title')اشتراكات الكورسات  @endslot
                                            @slot('total') {{$analysis_month['all_course_subscribes_count']}} @endslot
                                            @slot('percentage')  {{$analysis_month['new_course_subscribes_ratio']}}@endslot
                                            @slot('pClass')  progress-bar bg-info  @endslot
                                            @slot('pValue') {{$analysis_month['new_course_subscribes_count']}}  @endslot
                                        @endcomponent


                                        @component('common-components.dashboard-overview')
                                            @slot('mainClass') pb-3  @endslot
                                            @slot('title') الإيرادات  @endslot
                                            @slot('total'){{$analysis_month['all_invoices_amount']}}@endslot
                                            @slot('percentage'){{$analysis_month['new_invoices_amount_ratio']}}@endslot
                                            @slot('pClass')  progress-bar bg-danger  @endslot
                                            @slot('pValue'){{$analysis_month['new_invoices_amount']}}@endslot
                                        @endcomponent
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{--                        <div class="col-xl-3">--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-body">--}}
{{--                                    <h4 class="card-title mb-4">آراء اللاعبين</h4>--}}
{{--                                    <div class="mb-4">--}}
{{--                                        <h5><span class="text-primary">{{$all_players_count}}</span>+ لاعب</h5>--}}
{{--                                    </div>--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <i class="fas fa-quote-left h4 text-primary"></i>--}}
{{--                                    </div>--}}
{{--                                    <div id="reviewExampleControls" class="carousel slide review-carousel" data-ride="carousel">--}}

{{--                                        <div class="carousel-inner">--}}
{{--                                            <div class="carousel-item active">--}}
{{--                                                <div>--}}
{{--                                                    <p>To achieve this, it would be necessary to have uniform grammar, pronunciation and more common words</p>--}}
{{--                                                    <div class="media mt-4">--}}
{{--                                                        <div class="avatar-sm mr-3">--}}
{{--                                                            <span class="avatar-title bg-soft-primary text-primary rounded-circle">--}}
{{--                                                                    J--}}
{{--                                                                </span>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="media-body">--}}
{{--                                                            <h5 class="font-size-16 mb-1">Jessie Mitchell</h5>--}}
{{--                                                            <p class="mb-2">CEO of ABC Company</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="carousel-item">--}}
{{--                                                <div>--}}
{{--                                                    <p>For science, music, sport, etc, Europe uses the same vocabulary languages only differ in their grammar</p>--}}
{{--                                                    <div class="media mt-4">--}}
{{--                                                        <div class="avatar-sm mr-3">--}}
{{--                                                            <img src="images/users/avatar-4.jpg" alt="" class="img-fluid rounded-circle">--}}
{{--                                                        </div>--}}
{{--                                                        <div class="media-body">--}}
{{--                                                            <h5 class="font-size-16 mb-1">Kelly Rivera</h5>--}}
{{--                                                            <p class="mb-2">Web Developer</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="carousel-item">--}}
{{--                                                <div>--}}
{{--                                                    <p>The new common language will be more simple and regular than the existing European languages.</p>--}}
{{--                                                    <div class="media mt-4">--}}
{{--                                                        <div class="avatar-sm mr-3">--}}
{{--                                                            <span class="avatar-title bg-soft-primary text-primary rounded-circle">--}}
{{--                                                                    S--}}
{{--                                                                </span>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="media-body">--}}
{{--                                                            <h5 class="font-size-16 mb-1">Simon Hawkins</h5>--}}
{{--                                                            <p class="mb-2">CEO of XYZ Company</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <a class="carousel-control-prev" href="#reviewExampleControls" role="button" data-slide="prev">--}}
{{--                                            <i class="mdi mdi-chevron-left carousel-control-icon"></i>--}}
{{--                                        </a>--}}
{{--                                        <a class="carousel-control-next" href="#reviewExampleControls" role="button" data-slide="next">--}}
{{--                                            <i class="mdi mdi-chevron-right carousel-control-icon"></i>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
@endsection
@section('script')
        <!-- plugin js -->
        <script src="{{ URL::asset('libs/apexcharts/apexcharts.min.js')}}"></script>
        <!-- jquery.vectormap map -->
        <script src="{{ URL::asset('libs/jquery-vectormap/jquery-vectormap.min.js')}}"></script>
        <!-- Calendar init -->
        <script src="{{ URL::asset('js/pages/dashboard.init.js')}}"></script>

        <script src="{{ URL::asset('libs/datatables/datatables.min.js')}}"></script>
        <script src="{{ URL::asset('libs/jszip/jszip.min.js')}}"></script>
        <script src="{{ URL::asset('libs/pdfmake/pdfmake.min.js')}}"></script>
        <script src="{{ URL::asset('js/pages/datatables.init.js')}}"></script>
        <script>
            let colors=JSON.parse($('#data_groups').attr('data-colors'));
            let first_data=JSON.parse($('#data_groups').attr('data-data'));
            let terms=JSON.parse($('#data_groups').attr('data-terms'));
            var options = {
                series: first_data,
                chart: {
                    height: 350,
                    type: 'area'
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    type: 'String',
                    categories: terms
                },
            };
            var chart = new ApexCharts(document.querySelector("#line-chart-group-subscribes"), options);
            chart.render();
        </script>
        <script>
            let second_data=JSON.parse($('#data_profits').attr('data-data'));
            var options = {
                series: second_data,
                chart: {
                    type: 'bar',
                    height: 350,
                    stacked: true,
                    stackType: '100%'
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        legend: {
                            position: 'bottom',
                            offsetX: -10,
                            offsetY: 0
                        }
                    }
                }],
                xaxis: {
                    categories: terms,
                },
                fill: {
                    opacity: 1
                },
                legend: {
                    position: 'right',
                    offsetX: 0,
                    offsetY: 50
                },
            };
            var chart = new ApexCharts(document.querySelector("#column-chart-profits"), options);
            chart.render();
        </script>
    <script>
        let third_data=JSON.parse($('#data_sports').attr('data-data'));
        let sports=JSON.parse($('#data_sports').attr('data-sports'));
        var options = {
            series: third_data,
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: sports,
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#chart-sports"), options);
        chart.render();
    </script>
@endsection
