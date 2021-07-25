@extends('Purchase_layouts.Purchase_master_layout')
@section('content')

    <div class="app-admin-wrap layout-sidebar-large">
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="main-content">
                @include('Common_header_footer.pagetitle')
                <div class="separator-breadcrumb border-top"></div>
                <section class="contact-list">

                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{route('installmentdetails_print',$customerdetails->id)}}" class="btn-success btn-sm" style="float: right; color: #f7f7ff; margin-right: 20px;" target="_blank">Print</a>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div>
                                                <strong>Customer</strong>
                                            </div>
                                            ------------------------
                                            <div><strong> Name :  </strong>{{$customerdetails->customer_name}}</div>
                                            <div><strong>Father Name : </strong> {{$customerdetails->guardian_name}}</div>
                                            <div><strong>Address : </strong> {{$customerdetails->address}} </div>
                                            <div><strong>Phone : </strong> {{$customerdetails->mobile}} </div>
                                            <div><strong>Guardian Name : </strong> {{$customerdetails->guarantorname}} </div>
                                            <div><strong>Guardian Mobile : </strong> {{$customerdetails->guarantor_mobile}} </div>
                                            <div class="m-2">
                                                <button type="button" class="btn btn-warning investment_payment" id="{{$customerdetails->id}}">Payment</button>
                                            </div>

                                        </div>
                                        <div class="col-md-4">


                                        </div>
                                        <div class="col-md-4">
                                            <div>
                                                <strong>Bike Details</strong>
                                            </div>
                                            ------------------------
                                            <div><strong>Bike : </strong> {{$bikedetails->bike->name}} </div>
                                            <div><strong>Sell Price : </strong> {{$bikedetails->sell_price}} </div>
                                            <div><strong>Discount : </strong> {{$bikedetails->discount}} </div>
                                            <div><strong>Pay Amount : </strong> {{$bikedetails->last_total_amount}} </div>
                                            <div><strong>Cash Payment : </strong> {{$bikedetails->cashpayment}} </div>
                                            <div><strong>Interest : </strong> {{$bikedetails->interest}} </div>
                                            <div><strong>Due : </strong> {{$bikedetails->last_due_amount}} </div>
                                            <div><strong>Last Installment Due : </strong> {{$installment
->blanch}} </div>

                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-data data-table">
                                                <thead class="table-dark">
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Date</th>
                                                    <th>Install-NO</th>
                                                    <th>Amount</th>
                                                    <th>Pay date</th>
                                                    <th>Payment</th>
                                                    <th>Blanch</th>
                                                    <th>Status</th>

                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php $sl = 1; ?>
                                                @foreach ($totalinstallment as $row)

                                                    <tr>
                                                        <td>{{ $sl}}</td>
                                                        <td>{{ $row->payment_date}}</td>
                                                        <td>{{ $row->installment_no}}</td>
                                                        <td>{{ $row->installment_amount}}</td>
                                                        <td>{{ $row->install_paydate}}</td>
                                                        <td class="pay">{{ $row->pay_amount}}</td>
                                                        <td class="due">{{ $row->blanch}}</td>
                                                        <td><span class="badge badge-primary m-1 p-2"><?php $statusnew = $row->status; if ($statusnew==1) {echo "Paid";}else{echo "Due";} ?></span></td>
                                                    </tr>
                                                    <?php $sl++; ?>
                                                @endforeach


                                                <tr>
                                                    <td colspan="5" style="font-size: 14px; font-weight: bold; text-align: right;color: blue;" class="allpay"> </td>
                                                    <td colspan="5" style="font-size: 14px; font-weight: bold; text-align: left;color: red;" class="alldue"> </td>
                                                </tr>
                                                </tbody>
                                            </table>


                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                </section>

            </div>
        </div>
    </div>

    <div class="modal fade" id="installment_model" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Installment Payment</h4>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('instalment_payment.customer')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="customerid" id="installment_customer">
                        <input type="hidden" name="bikeid" id="sellbike_id">

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="" for=""> Customer :</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="" class="form-control" id="customer_name" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="" for=""> Sell Bike :</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="" class="form-control" id="sellbike" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="" for=""> Installment Amount :</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control" name="installment_no" id="Installment_amount">
                                        <option value="" id="" selected="selected"></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="" for=""> Installment Payment :</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="payment_inv" class="form-control" id="installment_payment" placeholder="Installment Payment" required autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('pagescript')

    <script>
        $(function(){
            $('.investment_payment').on('click', function(){
                var customerid = $(this).attr("id");

                $.ajax({
                    type: 'GET',
                    url:'/Installment_pay/'+customerid,

                    success: function (data) {
                        var mydata = $.parseJSON(data);
                        var accounts = mydata.orderdata;
                        var bikename = mydata.bikename;


                        $("#customer_name").val(bikename.customer_name);
                        $("#sellbike").val(bikename.name);
                        $("#sellbike_id").val(bikename.bikeid);
                        $("#installment_customer").val(customerid);

                        var select = '';
                        $.each(accounts, function (index, obj) {
                            select += ('<option value="'+ obj.id +'">'+"("+ obj.payment_date +")"+" - " + obj.blanch + '</option>');
                        });

                        $('#Installment_amount').html(select);
                    }
                });

                $("#installment_model").modal('show');

            });


        });
    </script>
{{--    <script type="text/javascript" src="{{ asset('Admin_asset/print/ajax.jquery.min.js') }}"></script>--}}
{{--    <script>--}}
{{--        $(function(){--}}
{{--            function tally (selector, columnname, textline="") {--}}
{{--                $(selector).each(function () {--}}
{{--                    var total = 0,--}}
{{--                        column = $(this).siblings(selector).andSelf().index(this);--}}
{{--                    $(this).parents().prevUntil(':has(' + selector + ')').each(function () {--}}
{{--                        total += parseFloat($(columnname + column + ')', this).html()) || 0;--}}
{{--                    })--}}
{{--                    $(this).html(textline+total);--}}
{{--                });--}}
{{--            }--}}
{{--            tally('td.allpay','td.pay:eq(' , "Last Pay Amount : ");--}}
{{--            tally('td.alldue','td.due:eq(' , "Last Due Amount : ");--}}

{{--        });--}}
{{--    </script>--}}

@endsection

