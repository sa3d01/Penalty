@extends('layouts.master')
@section('title') تسديد فاتورة @endsection
@section('content')
     @component('common-components.breadcrumb')
         @slot('title') تسديد فاتورة  @endslot
         @slot('li_1') {{$row->user->name}}  @endslot
     @endcomponent
     <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="invoice-title">
{{--                    <h4 class="float-right font-size-16">Order # 12345</h4>--}}
                    <div class="mb-4">
                        <img src="{{$row->user->avatar}}" alt="logo" height="20" />
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <address>
                                <strong>بيانات اللاعب:</strong><br>
                            {{$row->user->name}}<br>
                            {{$row->nationality}}<br>
                            {{$row->user->email}}<br>
                            {{$row->user->phone}}
                            </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mt-3">
                        <address>
                                <strong>تاريخ الدفع:</strong><br>
                            {{\Carbon\Carbon::now()->format('Y-M-d')}}<br><br>
                            </address>
                    </div>
                </div>
                <div class="py-2 mt-3">
                    <h3 class="font-size-15 font-weight-bold">التفاصيل</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 70px;">No.</th>
                                <th>الخدمة</th>
                                <th class="text-right">المبلغ المستحق</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $iteration=0;
                            $sub_total=0;
                        ?>
                        @foreach($player_courses as $player_course)
                            <?php $iteration++ ?>
                            @php
                                $course=\App\Models\Course::find($player_course->course_id);
                                $invoiced=\App\Models\Invoice::where('user_id',$row->user_id)->where(['model'=>'Course','model_id'=>$player_course->course_id])->first();
                                if ($invoiced){
                                    continue;
                                }
                                 $amount=$course->price;
                                 $sub_total+=$amount;
                            @endphp
                            <tr>
                                <td>{{$iteration}}</td>
                                <td>{{$course->name}}</td>
                                <td class="text-right">{{$amount}}</td>
                            </tr>
                        @endforeach
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
                                $sub_total+=$amount;
                            @endphp
                            @foreach($debit_months as $debit_month)
                                <?php $iteration++ ?>
                                <tr>
                                    <td>{{$iteration}}</td>
                                    <td>{{$group->name}} -- {{$debit_month}}</td>
                                    <td class="text-right">{{$group->price}}</td>
                                </tr>
                            @endforeach
                        @endforeach
                            <tr>
                                <td colspan="2" class="text-right">الاجمالي الفرعي</td>
                                <td class="text-right">{{$sub_total}} ريال </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="border-0 text-right">
                                    <strong>الخصم</strong></td>
                                <td class="border-0 text-right">0</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="border-0 text-right">
                                    <strong>الإجمالي</strong></td>
                                <td class="border-0 text-right">
                                    <h4 class="m-0">{{$sub_total}} ريال </h4></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-print-none">
                    <div class="float-right">
                        <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                        <a href="{{route('admin.player-invoice.invoicing',$row->id)}}" class="btn btn-primary w-md waves-effect waves-light" onclick="event.preventDefault();
                                                     document.getElementById('invoicing').submit();">
                            تسديد
                        </a>
                        <form id="invoicing" action="{{ route('admin.player-invoice.invoicing',$row->id) }}" method="POST" style="display: none;">
                            @csrf
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
