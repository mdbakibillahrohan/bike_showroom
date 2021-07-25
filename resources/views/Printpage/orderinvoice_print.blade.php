<link rel="stylesheet" href="{{ asset('Admin_asset/print/print.css')}}">

@extends('print_layouts.print_master_layout')
@section('content')

    <div class="main-content">
        <div class="page" id="invoice">
            <div class="printbtn" style="float: right">
                <input id ="printbtn" type="button" value="Print" class="btn btn-success btn-sm" onclick="window.print();" style=" margin-top: 12px;" >
                <script>
                    $(e).click(function(){
                        window.close();
                    });
                </script>
                <input id ="closebtn" type="button" value="Close" class="btn btn-danger btn-sm" onclick="window.close();" autofocus="autofocus" style=" margin-top: 12px; margin-left: 10px;">
            </div>
            <div class="companydata">
                <?php
                $showroomdata = Cache::get("showroom");
                $id = $showroomdata->id;
                $showroomdata = DB::table('showrooms')
                    ->where('id',$id)
                    ->first();
                ?>
                <div class="row">
                    <div class="col">
                        <div class="printhead">
                            <h5>{{$showroomdata->showroom_name}}</h5>
                            <h6>{{$showroomdata->showroom_details}}</h6>
                            <h6>{{$showroomdata->address.", ".$showroomdata->mobile}}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row customerdata">
                <div class="col-md-4">
                    <div class="text-gray-light">Name : {{$orderdetails[0]->customer->customer_name}}<strong></strong></div>
                    <div class="address">Address : {{$orderdetails[0]->customer->address}}</div>
                    <div class="email">Mobile : {{$orderdetails[0]->customer->mobile}}</div>
                    <div class="text-gray-light">Return Invoice : <span style="color: red;font-weight: bold"> {{@$orderdetails[0]->return_invoice}}</span></div>
                </div>
                <div class="col-md-4">
                    <h5 class="text-align=center">Invoice </h5>
                </div>
                <div class="col-md-4">
                    <div class="text-gray-light">Invoice : {{$orderdetails[0]->invoice_no}}</div>
                    <div class="email">Date : {{$orderdetails[0]->selldate}}</div>
                    <div class="email">Time : {{ date('h:i:s a',strtotime($orderdetails[0]->created_at)) }}</div>
                    <div class="text-gray-light">Return Cash : <span style="color: red;font-weight: bold"> {{@$orderdetails[0]->return_cash}}</span></div>
                </div>
            </div>
            <div class="row orderdata">
                <div class="table-responsive">
                    <table border="1" cellspacing="1" cellpadding="1" style="width:100%">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Product</th>
                            <th>Code</th>
                            <th>Symb</th>
                            <th>Details</th>
                            <th>Quantity</th>
                            <th>Sell Price</th>
                            <th>Total Sell</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sl=1;?>
                            @foreach($orderdetails as $data)
                            <tr>
                                <td>{{$sl}}</td>
                                <td>{{$data->product->product_name}}</td>
                                <td>{{$data->product_code}}</td>
                                <td>{{$data->attribute}}</td>
                                <td>{{$data->product_details}}</td>
                                <td>{{$data->quantity}}</td>
                                <td>{{$data->sellprice}}</td>
                                <td>{{$data->total_sellprice}}</td>
                            </tr>
                            <?php $sl ++ ;?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @php
                $totalinvoice = \App\Admin_model\CustomerAccount::where('customer_id',$orderdetails[0]->customer_id)->orderBy('id','DESC')->get();

                $invoice = [];
                foreach ($totalinvoice as $row){
                    $invoice [] = [
                        $row->invoice_id,
                        ];
                }

            /*    for ($i = 1; $i < count($invoice); $i++){
                    if ($invoice[$i][0]==$orderdetails[0]->invoice_no){
                        $pre_inv = $invoice[1][0];
                        $accounts = "Data Asy";
                    }else{
                       $accounts = "Data Nai";
                    }
                }*/
                    if ($invoice[0][0]==$orderdetails[0]->invoice_no){
                        $pre_inv = $invoice[1][0];
                        $previusdata_account = \App\Admin_model\CustomerAccount::where('invoice_id',$pre_inv)
                        ->first();
                    }else{
                       $previusdata_account = ["accounts" => "Not Show"];
                    }

                $invoicecalc = \App\Order_model\Order::where('invoice_no',$orderdetails[0]->invoice_no)
                ->select('invoice_no', DB::raw('SUM(total_sellprice) as total_sellprice'), DB::raw('SUM(sell_discount) as sell_discount'),DB::raw('SUM(sell_cost) as sell_cost'),DB::raw('SUM(lastsell_amount) as lastsell_amount'))
                ->groupBy('invoice_no')
                ->first();

                $customeraccount = \App\Admin_model\CustomerAccount::where('invoice_id',$orderdetails[0]->invoice_no)->orderBy('id','DESC')->first();

                $cashpayment = \App\Admin_model\Customerpayment::where('invoice_no',$orderdetails[0]->invoice_no)->where('payment_date',$orderdetails[0]->selldate)->first();
            @endphp

            <div class="inwords">
                    <h6>In words : (Payment)-
                        <?php use App\Http\Controllers\Admin_Controller\PrintController;
                        $number = $cashpayment->pay_amount;
                        echo PrintController::convert_number_to_words($number). " taka only."; ?>
                    </h6>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="customer_account">
                        <div>Total Sell : <b>{{$invoicecalc->total_sellprice}}</b></div>
                        <div>Other Cost : <b>{{$invoicecalc->sell_cost}}</b></div>
                        <div>Discount : <b>{{$invoicecalc->sell_discount}}</b></div>
                        <div>Payable Cash : <b>{{$invoicecalc->lastsell_amount}}</b></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="customer_account">
                        <div>Payment : <b>{{$cashpayment->pay_amount}}</b></div>
                        <div>Blanch : <b>{{$invoicecalc->lastsell_amount - $cashpayment->pay_amount }}</b></div>
                        <div>Previous : <b>{{@$previusdata_account->accounts}}</b></div>
                        <div>Last Blanch : <b>{{$customeraccount->accounts}}</b></div>
                    </div>
                </div>
            </div>
            <div class="footer_list">
                <div class="cust">
                    <h6>Customer Sign</h6>
                </div>
                <footer>
                    Invoice was created on a computer and is valid without the signature and seal.
                </footer>
            </div>
        </div>
    </div>


@endsection

