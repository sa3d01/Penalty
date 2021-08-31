@extends('layouts.master')
@section('title')  فاتورة @endsection
@section('content')
     @component('common-components.breadcrumb')
         @slot('title')  فاتورة  @endslot
         @slot('li_1') {{$player->user->name}}  @endslot
     @endcomponent
     <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="invoice-title">
                    <h4 class="float-right font-size-16"> # {{$invoice_id}}</h4>
                    <div class="mb-4">
                        <img src="{{$player->user->avatar}}" alt="logo" height="20" />
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <address>
                                <strong>بيانات اللاعب:</strong><br>
                            {{$player->user->name}}<br>
                            {{$player->nationality}}<br>
                            {{$player->user->email}}<br>
                            {{$player->user->phone}}
                            </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mt-3">
                        <address>
                                <strong>تاريخ الدفع:</strong><br>
                            {{\Carbon\Carbon::parse($invoices->first()->created_at)->format('Y-M-d')}}<br><br>
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
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    @if($invoice->model=='Course')
                                        <td>{{$invoice->course->name}}</td>
                                    @else
                                        <td>{{$invoice->group->name}} -- {{$invoice->month}}</td>
                                    @endif
                                    <td class="text-right">{{$invoice->amount}}</td>
                                </tr>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{URL::asset('/libs/toastr/toastr.min.js')}}"></script>
    <script src="{{URL::asset('/js/pages/toastr.init.js')}}"></script>
    <div style="visibility: hidden" id="msg" data-content="تمت العملية بنجاح"></div>
    <script type="text/javascript">
        $(document).ready(function () {
            var msg=$('#msg').attr('data-content');
            toastr.options = {
                "closeButton": true,
                "debug": true,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-left",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr.success(msg)
        })
    </script>
@endsection
