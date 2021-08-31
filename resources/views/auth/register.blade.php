@extends('layouts.master-without-nav')
@section('css')
    <link href="{{URL::asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
    <link href="{{asset('libs/dropify/dist/css/dropify.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('title') تسجيل أكاديمية @endsection

@section('body')

<body>
    @endsection

    @section('content')

    <div class="home-btn d-none d-sm-block">
        <a href="{{route('landing')}}" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card overflow-hidden">
                        <div class="bg-login text-center">
                            <div class="bg-login-overlay"></div>
                            <div class="position-relative">
                                <h5 class="text-white font-size-20">Free {{ __('Register') }}</h5>
                                <p class="text-white-50 mb-0">Get your free Mosharek account now</p>
                                <a href="{{route('landing')}}" class="logo logo-admin mt-4">
                                    <img src="{{asset('img/logo.png')}}" alt="" height="30">
                                </a>
                            </div>
                        </div>
                        <div class="card-body pt-5">

                            <div class="p-2">

                                <form method="POST" action="{{ route('admin.register') }}" enctype="multipart/form-data" data-parsley-validate novalidate>
                                    @csrf
                                    <div class="form-group">
                                        <label for="alloptions" class="control-label">الاسم</label>
                                        <input required type="text"  class="form-control @error('name') is-invalid @enderror" maxlength="25" name="name" id="alloptions" />
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="useremail">البريد الإلكتروني</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="useremail" placeholder="Enter email" autocomplete="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="userpassword">كلمة المرور</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" id="userpassword" placeholder="Enter password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="userpassword">تأكيد كلمة المرور </label>
                                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="userconfirmpassword" placeholder="Confirm password">
                                        @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">رقم الجوال</label>
                                        <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" required maxlength="13" placeholder="+966512345622" />
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="image">الشعار</label>
                                        <div class="card-box">
                                            <input name="avatar" id="input-file-now-custom-1 image @error('avatar') is-invalid @enderror" type="file" class="dropify"   data-default-file="{{asset('media/images/logo.jpeg')}}"/>
                                            @error('avatar')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">الدولة</label>
                                        <select name="country_id" class="form-control select2 @error('country_id') is-invalid @enderror">
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">المدينة</label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror" maxlength="25" name="city" id="alloptions" />
                                        @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">الحي</label>
                                        <input type="text" class="form-control @error('district') is-invalid @enderror" maxlength="25" name="district" id="alloptions" />
                                        @error('district')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">كيف سمعت عنا</label>
                                        <select name="ad_id" class="form-control select2">
                                            @foreach($ads as $ad)
                                                <option value="{{$ad->id}}">{{$ad->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="card-box">
                                        <h4 class="header-title mt-0 mb-3">الموقع</h4>
                                        <script async defer
                                                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjBZsq9Q11itd0Vjz_05CtBmnxoQIEGK8&&callback=initMap" type="text/javascript">
                                        </script>
                                        <div id="map" class="gmaps" style="position: relative; overflow: hidden;"></div>
                                        <input name="lat" type="hidden" id="lat">
                                        <input name="lng" type="hidden" id="lng">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">حجم الأكاديمية</label>
                                        <select id="academy_size_id" name="academy_size_id" class="form-control select2">
                                            @foreach($academy_sizes as $academy_size)
                                                <option value="{{$academy_size->id}}">{{$academy_size->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div id="single-coach-academy">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">بيانات المدرب</h4>
                                                <div class="form-group">
                                                    <label class="control-label">الرياضة</label>
                                                    <select name="sport_id" class="form-control select2">
                                                        @foreach($sports as $sport)
                                                            <option value="{{$sport->id}}">{{$sport->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">الجنسية</label>
                                                    <input required type="text" class="form-control" maxlength="25" name="nationality" id="alloptions" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">رقم الهوية</label>
                                                    <input required type="text" class="form-control" maxlength="50" name="nationality_id" id="alloptions" />
                                                </div>


                                            </div>
                                        </div>
                                    </div>


                                    <div class="mt-4">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" id="register" type="submit"> {{ __('Register') }}</button>
                                    </div>

{{--                                    <div class="mt-4 text-center">--}}
{{--                                        <p class="mb-0">By registering you agree to the Skote <a href="#" class="text-primary">Terms of Use</a></p>--}}
{{--                                    </div>--}}
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>Already have an account ? <a href="{{route('admin.login')}}" class="font-weight-medium text-primary"> Login</a> </p>
                        <p>© <script>
                                document.write(new Date().getFullYear())
                            </script> {{config('app.name', 'Laravel')}}. Crafted with <i class="mdi mdi-heart text-danger"></i> by DevEst</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ URL::asset('libs/jquery/jquery.min.js')}}"></script>
    <script src="{{ URL::asset('libs/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('libs/metismenu/metismenu.min.js')}}"></script>
    <script src="{{ URL::asset('libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ URL::asset('libs/node-waves/node-waves.min.js')}}"></script>

    <script src="{{ URL::asset('js/app.min.js')}}"></script>


    <script src="{{URL::asset('/libs/select2/select2.min.js')}}"></script>
    <script src="{{URL::asset('/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{URL::asset('/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{URL::asset('/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
    <script src="{{URL::asset('/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <!-- form advanced init -->
    <script src="{{URL::asset('/js/pages/form-advanced.init.js')}}"></script>
    <script src="{{asset('/libs/dropify/dist/js/dropify.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();
            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'Désolé, le fichier trop volumineux'
                }
            });
            // Used events
            var drEvent = $('#input-file-events').dropify();
            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });
            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });
            drEvent.on('dropify.errors', function(event, element) {
                console.log('Has Errors');
            });
            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
    </script>
    <script>
        $('#academy_size_id').change(function () {
            if ($('#academy_size_id').val()=='1'){
                $('#single-coach-academy').removeAttr('hidden');
            }else{
                $('#single-coach-academy').attr('hidden', 'hidden');
            }
        });
    </script>
    <script>
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                // center: {lat:  window.lat   , lng:  window.lng   },
                center: {lat: 24.774265, lng: 46.738586},
                zoom: 15,
                mapTypeId: 'roadmap'
            });
            var marker;
            google.maps.event.addListener(map, 'click', function (event) {
                map.setZoom();
                var mylocation = event.latLng;
                map.setCenter(mylocation);
                $('#lat').val(event.latLng.lat());
                $('#lng').val(event.latLng.lng());
                setTimeout(function () {
                    if (!marker)
                        marker = new google.maps.Marker({position: mylocation, map: map});
                    else
                        marker.setPosition(mylocation);
                }, 600);
            });
        }
    </script>

    @endsection
