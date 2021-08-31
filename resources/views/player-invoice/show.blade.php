@extends('layouts.master')

@section('title') {{$row->user->name}} @endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') اللاعبين  @endslot
         @slot('li_1') عرض  @endslot
     @endcomponent
    <?php
    $groups=$row->groups->pluck('sport_id')->toArray();
    $courses=$row->courses->pluck('sport_id')->toArray();
    $sports=array_merge($groups,$courses);
    $sports=\App\Models\Sport::whereIn('id',$sports)->get();

    $group_coaches=[];
    $group_academies=[];
    foreach ($row->groups as $player_group){
        $group_coaches[]=$player_group->coaches->pluck('coach_id')->toArray();
        $group_academies[]=$player_group->academy_id;
    }

    $course_coaches=[];
    $course_academies=[];
    foreach ($row->courses as $player_course){
        $course_coaches[]=$player_course->coaches->pluck('coach_id')->toArray();
        $course_academies[]=$player_course->academy_id;
    }

    $coaches_ids=array_merge($group_coaches,$course_coaches);
    $coaches_ids = array_filter($coaches_ids);

    $academies_ids=array_merge($group_academies,$course_academies);
    $academies_ids = array_filter($academies_ids);
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
                                                <p class="text-body mt-1 mb-1">{{$row->nationality}}</p>
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
                                        <p class="font-size-12 text-muted mb-1">رقم الهوية</p>
                                        <h6 class="">{{$row->nationality_id}}</h6>
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
                                        @foreach($sports as $sport)
                                            <li class="list-inline-item badge badge-primary"><span>{{$sport->name}}</span></li>
                                        @endforeach
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
                                                    <p class="mb-2">الأكاديميات</p>
                                                    <h4 class="mb-0">{{count($academies_ids)}}</h4>
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
                                                    <p class="mb-2">المدربين</p>
                                                    <h4 class="mb-0">{{count($coaches_ids)}}</h4>
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

                                <div class="col-md-12 col-xl-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <p class="mb-2">المستحقات</p>
                                                    <h4 class="mb-0">6,245</h4>
                                                </div>
                                                <div class="col-4">
                                                    <div class="text-right">
                                                        <div>
                                                            2.12 % <i class="mdi mdi-arrow-up text-success ml-1"></i>
                                                        </div>
                                                        <div class="progress progress-sm mt-3">
                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
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
