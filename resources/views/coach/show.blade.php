@extends('layouts.master')
@section('title') {{$row->user->name}} @endsection
@section('content')
    @component('common-components.breadcrumb')
         @slot('title') المدربين  @endslot
         @slot('li_1') عرض  @endslot
     @endcomponent
    <?php
    $group_academies=[];
    $group_players=[];
    foreach ($row->groups as $coach_group){
        $group_academies[]=$coach_group->academy_id;
        $group_players[]=$coach_group->players->pluck('player_id')->toArray();
    }

    $course_academies=[];
    $course_players=[];
    foreach ($row->courses as $coach_course){
        $course_academies[]=$coach_course->academy_id;
        $course_players[]=$coach_course->players->pluck('player_id')->toArray();
    }

    $academies_ids=array_merge($group_academies,$course_academies);
    $academies_ids = array_filter($academies_ids);

    $players_ids=array_merge($group_players,$course_players);
    $players_ids = array_filter($players_ids);
    ?>
        <!-- start row -->
        <div class="row">
                        <div class="col-md-12 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="profile-widgets py-3">
                                        <div class="text-center">
                                            <div class="">
                                                <img src="{{$row->user->avatar}}" alt="" class="avatar-lg mx-auto img-thumbnail rounded-circle">
                                                <div class="online-circle"><i class="fas fa-circle text-success"></i></div>
                                            </div>

                                            <div class="mt-3 ">
                                                <a href="#" class="text-dark font-weight-medium font-size-16">{{$row->user->name}}</a>
{{--                                                <p class="text-body mt-1 mb-1">{{$row->academy_size->name}}</p>--}}
{{--                                                <span class="badge badge-success">Follow Me</span>--}}
{{--                                                <span class="badge badge-danger">Message</span>--}}
                                            </div>

                                            <div class="row mt-4 border border-left-0 border-right-0 p-3">
                                                <div class="col-md-6">
                                                    <h6 class="text-muted">
                                                    الجروبات
                                                </h6>
                                                    <h5 class="mb-0">{{$row->groups->count()}}</h5>
                                                </div>

                                                <div class="col-md-6">
                                                    <h6 class="text-muted">
                                                    الكورسات
                                                </h6>
                                                    <h5 class="mb-0">{{$row->courses->count()}}</h5>
                                                </div>
                                            </div>

                                            <div class="mt-4">

                                                <ui class="list-inline social-source-list">
                                                    <li class="list-inline-item">
                                                        <div class="avatar-xs">
                                                            <span class="avatar-title rounded-circle">
                                                                    <i class="mdi mdi-facebook"></i>
                                                                </span>
                                                        </div>
                                                    </li>

                                                    <li class="list-inline-item">
                                                        <div class="avatar-xs">
                                                            <span class="avatar-title rounded-circle bg-info">
                                                                    <i class="mdi mdi-twitter"></i>
                                                                </span>
                                                        </div>
                                                    </li>

                                                    <li class="list-inline-item">
                                                        <div class="avatar-xs">
                                                            <span class="avatar-title rounded-circle bg-pink">
                                                                <i class="mdi mdi-instagram"></i>
                                                            </span>
                                                        </div>
                                                    </li>
                                                </ui>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">البيانات العامة</h5>
                                    <div class="mt-3">
                                        <p class="font-size-12 text-muted mb-1">البريد الإلكتروني</p>
                                        <h6 class="">{{$row->user->email}}</h6>
                                    </div>

                                    <div class="mt-3">
                                        <p class="font-size-12 text-muted mb-1">الهاتف</p>
                                        <h6 class="">{{$row->user->phone}}</h6>
                                    </div>

                                    <div class="mt-3">
                                        <p class="font-size-12 text-muted mb-1">تاريخ الإنضمام</p>
                                        <h6 class="">{{\Carbon\Carbon::parse($row->created_at)->format('Y-m-d')}}</h6>
                                    </div>

                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-2">الرياضات النشطه</h5>
                                    <ul class="list-unstyled list-inline language-skill mb-0">
                                        <li class="list-inline-item badge badge-primary"><span>{{$row->sport->name}}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-xl-9">
                            <div class="row">
                                <div class="col-md-12 col-xl-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <p class="mb-2">اللاعبين</p>
                                                    <h4 class="mb-0">{{count($players_ids)}}</h4>
                                                </div>
                                                <div class="col-4">
                                                    <div class="text-right">
                                                        <div>
                                                            2.06 % <i class="mdi mdi-arrow-up text-success ml-1"></i>
                                                        </div>
                                                        <div class="progress progress-sm mt-3">
                                                            <div class="progress-bar" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-xl-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <p class="mb-2">الأكاديميات</p>
                                                    <h4 class="mb-0">{{count($academies_ids)}}</h4>
                                                </div>
                                                <div class="col-4">
                                                    <div class="text-right">
                                                        <div>
                                                            3.12 % <i class="mdi mdi-arrow-up text-success ml-1"></i>
                                                        </div>
                                                        <div class="progress progress-sm mt-3">
                                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#groups" role="tab">
                                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                <span class="d-none d-sm-block">الجروبات</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#courses" role="tab">
                                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                <span class="d-none d-sm-block">الكورسات</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content p-3 text-muted">
                                        <div class="tab-pane active" id="groups" role="tabpanel">
                                            <div class="timeline-count mt-5">
                                                <!-- Timeline row Start -->
                                                <div class="row">
                                                    @foreach($row->groups as $group)
                                                        <div class="timeline-box col-lg-4" style="margin-bottom: 5%">
                                                            <div class="mb-5 mb-lg-0">
                                                                <div class="item-lable bg-primary rounded">
                                                                    <p class="text-center text-white">{{$group->name}}</p>
                                                                </div>
                                                                <div class="timeline-line active">
                                                                    <div class="dot bg-primary"></div>
                                                                </div>
                                                                <div class="vertical-line">
                                                                    <div class="wrapper-line bg-light"></div>
                                                                </div>
                                                                <div class="bg-light p-4 rounded mx-3">
                                                                    <span class="badge badge-success">{{$group->sport->name}}</span>
                                                                    <span class="badge badge-warning">{{$group->price}} ريال </span>
                                                                    <hr>
                                                                    <span class="badge badge-info">أيام التدريب</span>
                                                                    <p>{{json_encode($group->days)}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <!-- Timeline row Over -->
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="courses" role="tabpanel">
                                            <div class="timeline-count mt-5">
                                                <!-- Timeline row Start -->
                                                <div class="row">
                                                    @foreach($row->courses as $course)
                                                        <div class="timeline-box col-lg-4" style="margin-bottom: 5%">
                                                            <div class="mb-5 mb-lg-0">
                                                                <div class="item-lable bg-primary rounded">
                                                                    <p class="text-center text-white">{{$course->name}}</p>
                                                                </div>
                                                                <div class="timeline-line active">
                                                                    <div class="dot bg-primary"></div>
                                                                </div>
                                                                <div class="vertical-line">
                                                                    <div class="wrapper-line bg-light"></div>
                                                                </div>
                                                                <div class="bg-light p-4 rounded mx-3">
                                                                    <span class="badge badge-success">{{$course->sport->name}}</span>
                                                                    <span class="badge badge-warning">{{$course->price}} ريال </span>
                                                                    <hr>
                                                                    <span class="badge badge-info">أيام التدريب</span>
                                                                    <p>{{json_encode($course->days)}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <!-- Timeline row Over -->

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>


             </div>
        <!-- end row -->
    @endsection

    @section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/libs/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{ URL::asset('/js/pages/profile.init.js')}}"></script>
    @endsection
