@extends('layouts.master')

@section('title') {{$row->user->name}} @endsection

@section('content')

     @component('common-components.breadcrumb')
         @slot('title') تفاصيل المديونية  @endslot
         @slot('li_1') {{$row->user->name}}  @endslot
     @endcomponent

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="text-center mb-5">
            <h4>تفاصيل المديونية</h4>
        </div>
    </div>
</div>

<div class="row">
@foreach($player_groups as $player_group)
    @php
            $end    = new \DateTime();
            $start      = new \DateTime(\Carbon\Carbon::parse($player_group->created_at)->toDateTimeString());
            $interval = \DateInterval::createFromDateString('1 month');
            $period   = new \DatePeriod($start, $interval, $end);
            $months = array();
            foreach ($period as $dt) {
                $months[] = $dt->format("F Y");
            }
            $months_list= $months;
            $last_invoices_months=\App\Models\Invoice::where('user_id',$row->user_id)->where(['model'=>'Group','model_id'=>$player_group->group_id])->pluck('month')->toArray();
            $debit_months=array_diff($months_list,$last_invoices_months);
            $group=\App\Models\Group::find($player_group->group_id);
            $amount=$group->price * count($debit_months);
    @endphp
        <div class="col-xl-3 col-md-6">
            <div class="card plan-box">
                <div class="card-body p-4">
                    <div class="media">
                        <div class="media-body">
                            <h5>{{ $group->name }}</h5>
                            <p class="text-muted">{{ json_encode($debit_months) }}</p>
                        </div>
                        <div class="ml-3">
                            <i class="bx bx-football h1 text-primary"></i>
                        </div>
                    </div>
                    <div class="py-4 mt-4 text-center bg-soft-light">
                        <h1 class="m-0"><sup><small>ريال</small></sup> {{ $amount }}</h1>
                    </div>
                    <div class="text-center">
                        <a data-user_id='{{$row->user_id}}' data-model='Group' data-amount="{{$amount}}" data-model_id='{{$group->id}}' data-cashier_id='{{\Illuminate\Support\Facades\Auth::id()}}'  data-href='{{route('admin.player-invoice.invoicing',$row->id)}}' class="invoicing btn btn-primary waves-effect waves-light">تسديد</a>
                    </div>
                </div>
            </div>
        </div>
@endforeach
@foreach($player_courses as $player_course)
    @php
        $course=\App\Models\Course::find($player_course->course_id);
         $amount=$course->price;
    @endphp
        <div class="col-xl-3 col-md-6">
            <div class="card plan-box">
                <div class="card-body p-4">
                    <div class="media">
                        <div class="media-body">
                            <h5>{{ $course->name }}</h5>
                            <p class="text-muted">{{ $course->from_date .'  -   '. $course->to_date }}</p>
                        </div>
                        <div class="ml-3">
                            <i class="bx bx-football h1 text-primary"></i>
                        </div>
                    </div>
                    <div class="py-4 mt-4 text-center bg-soft-light">
                        <h1 class="m-0"><sup><small>ريال</small></sup> {{ $amount }}</h1>
                    </div>
                    <div class="text-center">
                        <a data-user_id='{{$row->user_id}}' data-model='Course' data-amount="{{$amount}}" data-model_id='{{$course->id}}' data-cashier_id='{{\Illuminate\Support\Facades\Auth::id()}}'  data-href='{{route('admin.player-invoice.invoicing',$row->id)}}' class="invoicing btn btn-primary waves-effect waves-light">تسديد</a>
                    </div>
                </div>
            </div>
        </div>
@endforeach
</div>
<!-- end row -->
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $(document).on('click', '.invoicing', function (e) {
            e.preventDefault();
            let user_id=$(this).data('user_id')
            let cashier_id=$(this).data('cashier_id')
            let  model_id=$(this).data('model_id')
            let  model=$(this).data('model')
            let  amount=$(this).data('amount')
            let _token   = $('meta[name="csrf-token"]').attr('content');
            Swal.fire({
                title: 'من فضلك اذكر رقم الفاتورة',
                input: 'text',
                showCancelButton: true,
                confirmButtonText: 'إتمام',
                cancelButtonText: 'الغاء',
                showLoaderOnConfirm: true,
                preConfirm: (invoice_id) => {
                    $.ajax({
                        url: $(this).data('href'),
                        type:'POST',
                        data:{
                            invoice_id:invoice_id,
                            user_id:user_id,
                            cashier_id:cashier_id,
                            model_id:model_id,
                            model:model,
                            amount:amount,
                            _token: _token
                        }
                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then(() => {
                location.reload();
            })
        });
    </script>
@endsection
