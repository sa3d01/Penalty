@extends('layouts.master')
@section('title') تعديل بيانات مدير @endsection
@section('css')
<link href="{{URL::asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
<link href="{{asset('libs/dropify/dist/css/dropify.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
 @component('common-components.breadcrumb')
         @slot('title') المديرين  @endslot
         @slot('li_1') تعديل بيانات مدير  @endslot
 @endcomponent
 @if($errors->any())
     <div class="alert alert-danger" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
         @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
         @endforeach
     </div>
 @endif
 <form method="POST" action="{{route('admin.admins.update',$admin->id)}}" enctype="multipart/form-data" data-parsley-validate novalidate>
     @csrf
     @method('PUT')
        <div class="row">
            <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">البيانات العامة</h4>
                    <div class="form-group">
                        <label class="control-label">الاسم</label>
                        <input required value="{{$admin->name}}" type="text" class="form-control" maxlength="25" name="name" id="alloptions" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">البريد الإلكتروني</label>
                        <input name="email" value="{{$admin->email}}" type="email" class="form-control" required parsley-type="email" placeholder="Enter a valid e-mail" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">رقم الجوال</label>
                        <input name="phone" value="{{$admin->phone}}" type="text" class="form-control" required maxlength="13" placeholder="+966512345622" />
                    </div>
                    <div class="form-group">
                        <label>كلمة المرور</label>
                        <div>
                            <input name="password" type="password" id="pass2" class="form-control" placeholder="Password" />
                        </div>
                        <div class="mt-2">
                            <input type="password" class="form-control" data-parsley-equalto="#pass2" placeholder="Re-Type Password" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">الصلاحيات</h4>
                        <div class="form-group">
                            <label for="image">الصورة الشخصية</label>
                            <div class="card-box">
                                <input name="avatar" id="input-file-now-custom-1 image" type="file" class="dropify" data-default-file="{{$admin->avatar}}"  />
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <label class="control-label">الصلاحيات</label>
                            <select name="permissions[]" class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose ...">
                                @foreach($permissions as $permission)
                                    <option value="{{$permission->id}}" @if(in_array($permission->id,$adminPermissions)) selected @endif>{{$permission->slug}}</option>
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
