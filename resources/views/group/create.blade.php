@extends('layouts.master')
@section('title') إضافة جروب @endsection
@section('css')
<link href="{{URL::asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
<link href="{{asset('libs/dropify/dist/css/dropify.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
 @component('common-components.breadcrumb')
         @slot('title') الجروبات  @endslot
         @slot('li_1') إضافة جروب  @endslot
 @endcomponent
 @if($errors->any())
     <div class="alert alert-danger" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
         @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
         @endforeach
     </div>
 @endif
 <form method="POST" action="{{route('admin.group.store')}}" enctype="multipart/form-data" data-parsley-validate novalidate>
     @csrf
     @method('POST')
        <div class="row">
            <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">البيانات العامة</h4>
                    <div class="form-group">
                        <label class="control-label">الاسم</label>
                        <input required type="text" class="form-control" maxlength="25" name="name" id="alloptions" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">السعر</label>
                        <input required type="number" class="form-control" name="price" min="0"  />
                    </div>
                    @if (in_array('SUPER_ADMIN',auth()->user()->getRoleNames()->toArray()))
                        <div class="form-group">
                            <label class="control-label">الأكاديمية</label>
                            <select name="academy_id" class="form-control select2">
                                @foreach(\App\Models\Academy::all() as $academy)
                                    <option value="{{$academy->id}}">{{$academy->user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        @if(auth()->user()->type=='ADMIN')
                            <input hidden name="academy_id" value="{{auth()->user()->admin->academy->id}}">
                        @else
                            <input hidden name="academy_id" value="{{auth()->user()->academy->id}}">
                        @endif
                    @endif
                    <div class="form-group">
                        <label class="control-label">الرياضة</label>
                        <select name="sport_id" class="form-control select2">
                            @foreach($sports as $sport)
                                <option value="{{$sport->id}}">{{$sport->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-0">
                        <label class="control-label">أيام التدريب</label>
                        <select name="days[]" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose ...">
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="example-time-input">موعد بدأ التدريب</label>
                        <input name="start_time" class="form-control" type="time" value="13:45:00" id="example-time-input">
                    </div>
                    <div class="form-group">
                        <label class="control-label">عدد ساعات التدريب</label>
                        <input required type="number" class="form-control" name="duration" min="0"  />
                    </div>

                    <div class="form-group">
                        <label class="control-label">ملاحظات أخري</label>
                        <textarea class="form-control" name="comment"></textarea>
                    </div>

                </div>
            </div>
        </div>
            <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">التسجيل</h4>
                    <div class="form-group mb-0">
                        <label class="control-label">المدربين</label>
                        <select name="coaches[]" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose ...">
                            @foreach($coaches as $coach)
                            <option value="{{$coach->id}}">{{$coach->user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label class="control-label">اللاعبين</label>
                        <select name="players[]" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose ...">
                            @foreach($players as $player)
                            <option value="{{$player->id}}">{{$player->user->name}}</option>
                            @endforeach
                        </select>
                    </div>


                </div>
            </div>
            <!-- end select2 -->
        </div>
        </div>
        <div class="row">
            <div class="form-group">
                <button class="btn btn-primary waves-effect waves-light mr-12" type="submit">
                    تأكيد
                </button>
            </div>
        </div>
    </form>
<!-- end row -->


<!-- end row -->
@endsection

@section('script')

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
@endsection
