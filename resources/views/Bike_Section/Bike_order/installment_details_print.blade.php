<link rel="stylesheet" href="{{ asset('Admin_asset/print/fullprint.css')}}">

@extends('print_layouts.print_master_layout')
@section('content')

    <div id="product">
        <div class="product overflow-auto">

            <div class="shohroomdata">
                <?php
                $showroomdata = Cache::get("showroom");
                $id = $showroomdata->id;
                $showroomdata = DB::table('showrooms')
                    ->where('id',$id)
                    ->first();
                ?>

                <div class="row">
                    <div class="col-md-3">
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

                    </div>
                    <div class="col-md-4 text-center">
                            <h4>{{$showroomdata->showroom_name}}</h4>
                            <h6>{{$showroomdata->showroom_details}}</h6>
                            <h6>{{$showroomdata->address.", ".$showroomdata->mobile}}</h6>
                    </div>
                    <div class="col-md-2 text-center">

                    </div>
                    <div class="col-md-3">
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
            </div>

            <main>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive m-b-40">
                            <table class="table table-striped table-data3 data-table1">
                                <thead>
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
                                    <td colspan="7" style="font-size: 14px; font-weight: bold; text-align: right;" class="allpay"> </td>
                                </tr>
                                <tr>
                                    <td colspan="7" style="font-size: 14px; font-weight: bold; text-align: right;" class="alldue"> </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="signaturre">
                    <h6 style="text-align: right;
    margin-right: 46px; text-decoration: underline; margin-bottom: 10px;"></h6>
                    <hr>
                    <p style="text-align: center">Invoice was created on a computer and is valid without the signature and seal.</p>
                </div>
            </main>
        </div>
    </div>

@endsection
@section('pagescript')
    <script type="text/javascript" src="{{ asset('Admin_asset/print/ajax.jquery.min.js') }}"></script>
    <script>

        $(function(){
            function tally (selector, columnname, textline="") {
                $(selector).each(function () {
                    var total = 0,
                        column = $(this).siblings(selector).andSelf().index(this);
                    $(this).parents().prevUntil(':has(' + selector + ')').each(function () {
                        total += parseFloat($(columnname + column + ')', this).html()) || 0;
                    })
                    $(this).html(textline+total);
                });
            }
            tally('td.allpay','td.pay:eq(' , "Last Pay Amount : ");
            tally('td.alldue','td.due:eq(' , "Last Due Amount : ");

        });
    </script>
@endsection
