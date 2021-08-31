<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="{{auth()->user()->avatar}}" alt="" class="avatar-md mx-auto rounded-circle">
            </div>
            <div class="mt-3">
                <a href="#" class="text-dark font-weight-medium font-size-16">{{auth()->user()->name}}</a>
                <p class="text-body mt-1 mb-0 font-size-13">{{auth()->user()->type}}</p>
            </div>
        </div>
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    @can('admins')
                        <li class="menu-title">الإدارة</li>
                        <li>
                            <a href="javascript: void(0);">
                                <i class="mdi mdi-office-building"></i>
                                <span> الإدارة </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="{{route('admin.admins.create')}}">إضافة مدير جديدة</a></li>
                                <li><a href="{{route('admin.admins.index')}}">عرض الكل</a></li>
                            </ul>
                        </li>
                    @endcan
                    <li class="menu-title">قائمة الأعضاء</li>
                    @can('academies')
                        <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-flip-horizontal"></i>
                            <span>الأكادميات</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('admin.academy.index')}}">عرض الكل</a></li>
                            <li><a href="{{route('admin.academy.waiting')}}">الطلبات المعلقة</a></li>
                            <li><a href="{{route('admin.academy.create')}}">إضافة</a></li>
                        </ul>
                    </li>
                    @endcan
                    @can('coaches')
                        <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-gamepad-square"></i>
                            <span>المدربين</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('admin.coach.index')}}">عرض الكل</a></li>
                            <li><a href="{{route('admin.coach.create')}}">إضافة</a></li>
                        </ul>
                    </li>
                    @endcan
                    @can('players')
                        <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-football"></i>
                            <span>اللاعبين</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('admin.player.index')}}">عرض الكل</a></li>
                            <li><a href="{{route('admin.player.create')}}">إضافة</a></li>
                        </ul>
                    </li>
                    @endcan
                    @can('invoices')
                        <li class="menu-title">إدارة الاشتراكات والتحصيل</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-play"></i>
                                <span>اللاعبين</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{route('admin.player-invoice.index')}}">عرض الكل</a></li>
                            </ul>
                        </li>
                    @endcan
                    @can('groups'||'courses')
                        <li class="menu-title">قائمة الفعاليات</li>
                    @endcan
                    @can('groups')
                        <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-play"></i>
                            <span>الجروبات</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('admin.group.index')}}">عرض الكل</a></li>
                            <li><a href="{{route('admin.group.create')}}">إضافة</a></li>
                        </ul>
                    </li>
                    @endcan
                    @can('courses')
                        <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-play-network"></i>
                            <span>الكورسات</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('admin.course.index')}}">عرض الكل</a></li>
                            <li><a href="{{route('admin.course.create')}}">إضافة</a></li>
                        </ul>
                    </li>
                    @endcan
                    @can('settings')
                        <li class="menu-title">قائمة محتويات النظام</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-flag"></i>
                                <span>الدول</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{route('admin.country.index')}}">عرض الكل</a></li>
                                <li><a href="{{route('admin.country.create')}}">إضافة</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-box-cutter"></i>
                                <span>تصنيفات الأكاديميات</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{route('admin.academy_size.index')}}">عرض الكل</a></li>
                                <li><a href="{{route('admin.academy_size.create')}}">إضافة</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-contacts"></i>
                                <span>وسائل الإعلان</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{route('admin.ad.index')}}">عرض الكل</a></li>
                                <li><a href="{{route('admin.ad.create')}}">إضافة</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-boxing-glove"></i>
                                <span>الرياضات</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{route('admin.sport.index')}}">عرض الكل</a></li>
                                <li><a href="{{route('admin.sport.create')}}">إضافة</a></li>
                            </ul>
                        </li>
                    @endcan
                </ul>
            </div>
    </div>
</div>
<!-- Left Sidebar End -->
