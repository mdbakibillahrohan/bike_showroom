@extends('Purchase_layouts.Purchase_master_layout')
@section('content')

    <div class="app-admin-wrap layout-sidebar-large">
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="main-content">
                @include('Common_header_footer.pagetitle')

                <section class="contact-list">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <form action="#" enctype="multipart/form-data">

                                        <input type="hidden" name="" id="product_details">
                                        <input type="hidden" name="" id="customerid_store">
                                        <input type="hidden" name="" id="customer_status">
                                        <input type="hidden" name="" id="custome_ledger">
                                        <input type="hidden" name="" id="selltype">
                                        <input type="hidden" name="" id="product_namevalu">
                                        <input type="hidden" name="" id="productidval">
                                        <input type="hidden" name="" id="return_amount">
                                        <input type="hidden" name="" id="return_id">
                                        <input type="hidden" name="" id="symboledatanew">

                                        <div class="row rowpad">
                                            <div class="col-md-1">
                                                <div class="test">

                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="test" style="margin-top: 30px">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcustomer">Add</button>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-control-label">Customer Name: <span class="tx-danger"> *</span></label>
                                                    <select name="customerid" class="form-control" id="customer_id" value="{{@$customer[0]->id}}">
                                                        <option value="{{@$customer[0]->id}}">{{@$customer[0]->customer_name}}</option>
                                                        @foreach ($customer as $data)
                                                            <option value="{{$data->id}}">{{$data->customer_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="form-control-label">Sale Date : <span class="tx-danger"> *</span></label>
                                                    <?php  use Illuminate\Support\Facades\Cache;$n_dat= date("Y-m-d"); ?>
                                                    <input type="date" class="form-control" name="" id="sellingdate" value="{{$n_dat}}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="form-control-label">Stoke : <span class="tx-danger"> *</span></label>
                                                    <input type="text" class="form-control" id="stoke_qty" disabled style="width: 100%;font-size: 13px; color: red;font-weight: bold;">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-control-label">Details : <span class="tx-danger"> *</span></label>
                                                    <input type="text" class="form-control" id="productdetails" disabled style="width: 100%;font-size: 13px; color: red;font-weight: bold;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-control-label">Product Name: <span class="tx-danger"> *</span></label>
                                                    <input  class="form-control newtag" id="tags" placeholder="Product Name" required tabindex="1" onkeypress="focusNext(event)">
                                                    <div class="invalid-feedback">
                                                        Please Select a Product Name !
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-control-label">Barcode Search : <span class="tx-danger"> *</span></label>
                                                    <input type="text" autofocus="autofocus" class="form-control" name="bercodeinput" id="bercode_input_data" placeholder="Input Bercode" style="padding-left: 54px;" onkeydown="focusNext(event)" autocomplete="off"><img src="{{asset('Media/icon/barcode.png')}}" alt="" style="width: 38px; margin-top: -60px; margin-left: -218px;" >
                                                </div>
                                            </div>

                                            <div class="row order_group" style="margin-top: 1px;margin-right: -6px;">

                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="form-control-label">Total Qty: <span class="tx-danger"> *</span></label>
                                                    <input type="number" class="form-control" name="sale_qty" id="sell_quantity" placeholder="Total Quantity" onkeydown="focusNext(event)" autocomplete="off">
                                                    <div class="invalid-feedback">
                                                        Please Select a Total Qty!
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="form-control-label">Sell Price: <span class="tx-danger"> *</span></label>
                                                    <input type="number" class="form-control" name="sale_price" id="sellprice_data" placeholder="Sell Price" onkeydown="focusNext(event)" autocomplete="off">
                                                    <div class="invalid-feedback">
                                                        Please Select a Sell Price !
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-1" style="margin-top: 30px;margin-left: -28px;">
                                                <button type="button" id="addbtn" class="glyphicon glyphicon-plus btn-primary btn-sm " aria-label="" onkeypress="focusNext(event)"> +
                                                </button>
                                            </div>
                                        </div>

                                        <hr style="display: block; height: 2px; border: 0; border-top: 4px solid rebeccapurple; margin: 1em 0; padding: 0;  margin-top: 5px;">

                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="col-xs-12 table-responsive">
                                                    <table class="table table-bordered table-hover table-sm" id="item_list">
                                                        <thead class="thead" style="background-color: #6f008b;color: yellow;">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Product</th>
                                                            <th>Code</th>
                                                            <th>Product ID</th>
                                                            <th>Quantity</th>
                                                            <th>Sell Price </th>
                                                            <th>Total Sell</th>
                                                            <th>Remove</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row">
                                                    <hr style="display: block; height: 2px; border: 0; border-top: 4px solid #ff6115; margin: 1em 0; padding: 0;  margin-top: 5px;">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class=" col-md-5">
                                                                    <label class="login3 pull-right pull-right-pro">Sub Total :</label>
                                                                </div>
                                                                <div class=" col-md-7">
                                                                    <input class="form-control" type="text" id="subtotal_data" disabled placeholder="Sub Total" style=" color: red;font-weight: bold; font-size: 15px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class=" col-md-5">
                                                                    <label class="login3 pull-right pull-right-pro">Return Invoice :</label>
                                                                </div>
                                                                <div class=" col-md-7">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <input class="form-control" type="text" id="Invoice" placeholder="Invoice" onkeydown="focusNext(event)" autocomplete="off">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <input class="form-control" type="text" id="return_amount_taka" placeholder="Amount"  disabled>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class=" col-md-5">
                                                                    <label class="login3 pull-right pull-right-pro">Other Cost :</label>
                                                                </div>
                                                                <div class=" col-md-7">
                                                                    <input type="text" class="form-control" name="cost" id="sell_cost" style="font-weight: bold" placeholder="Cost" onkeydown="focusNext(event)" autocomplete="off"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class=" col-md-5">
                                                                    <label class="login3 pull-right pull-right-pro" >Discount :</label>
                                                                </div>
                                                                <div class=" col-md-7">
                                                                    <input type="text" class="form-control" name="discount" id="discount_sell" style="font-weight: bold" placeholder="Discount Amount" onkeydown="focusNext(event)" autocomplete="off"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class=" col-md-5">
                                                                    <label class="login3 pull-right pull-right-pro" >Grand Total : </label>
                                                                </div>
                                                                <div class=" col-md-7">
                                                                    <input type="text" class="form-control" id="grandtotal" disabled="" style="font-weight: bold" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class=" col-md-5">
                                                                    <label class="login3 pull-right pull-right-pro" >Cash Payment :</label>
                                                                </div>
                                                                <div class=" col-md-7">
                                                                    <input type="text" class="form-control" name="cashpayment" id="cash_payment" style="font-weight: bold" placeholder="Payment" onkeydown="focusNext(event)" autocomplete="off"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class=" col-md-5">
                                                                    <label class="login3 pull-right pull-right-pro" >Blanch :</label>
                                                                </div>
                                                                <div class=" col-md-7">
                                                                    <input type="text" class="form-control " name="" id="actual_blanch" style="font-weight: bold" disabled/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class=" col-md-5">
                                                                    <label class="login3 pull-right pull-right-pro" >Previous Acc :</label>
                                                                </div>
                                                                <div class=" col-md-7">
                                                                    <input type="text" class="form-control" id="customer_account" disabled="" style="font-weight: bold"/>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class=" col-md-5">
                                                                    <label class="login3 pull-right pull-right-pro" >Last Blanch :</label>
                                                                </div>
                                                                <div class=" col-md-7">
                                                                    <input type="text" class="form-control" id="last_balanch" disabled="" style="font-weight: bold;color: red;" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class=" col-md-5">
                                                                    <label class="login3 pull-right pull-right-pro" >Payment Status :</label>
                                                                </div>
                                                                <div class=" col-md-7">
                                                                    <select class="form-control" name="" id="paymentmode" style="height: 35px;">
                                                                        <option value="cash">Cash</option>
                                                                        <option value="card">Credit Card</option>
                                                                        <option value="mobile">Mobile Bank</option>
                                                                        <option value="cheque">Cheque</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Total Sell Amount </label>
                                                        <input class="form-control" type="text" id="singlesubtotal" placeholder="Calculate" disabled style=" color: red;font-weight: bold; font-size: 16px;">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Customer Name </label>

                                                        <input class="form-control" type="text" id="Customername" placeholder="Customer name" disabled style=" color: red;font-weight: bold; font-size: 16px;">
                                                    </div>
                                                </div>
                                                <div class="payment_group">

                                                </div>
                                                <div class="row notediv">
                                                    <div class="form-group">
                                                        <label class="form-control-label">Note Details </label>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input class="form-control" type="text" id="note_input" placeholder="Pay Note" onkeydown="focusNext(event)" autocomplete="off">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input class="form-control" type="text" id="return_show" placeholder="Return" disabled>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="form-actions text-center">
                                        <button class="btn btn-primary pull-center" id="order_submit_btn" onkeypress="focusNext(event)">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="row m-t-30">
                    <div class="col-md-12">
                        <div class="table-responsive m-b-40">
                            <table class="table table-hover" id="ul-contact-list" style="width:100%">
                                <thead class="table-dark" style="font-size: 13px">
                                <tr style="font-size: 13px">
                                    <th>SL</th>
                                    <th>Date</th>
                                    <th>Invoice</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>SellCost</th>
                                    <th>Discount</th>
                                    <th>TotalSell</th>
                                    <th>Payment</th>
                                    <th>Blanch</th>
                                    <th>Delete</th>
                                    <th>Print</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $sl = 1; ?>
                                @foreach ($neworderdata as $data=>$row)

                                    @php
                                        $invoicecalc = \App\Order_model\Order::where('invoice_no',$row[0]->invoice_no)
                                        ->select('invoice_no', DB::raw('SUM(total_sellprice) as total_sellprice'), DB::raw('SUM(sell_discount) as sell_discount'),DB::raw('SUM(sell_cost) as sell_cost'),DB::raw('SUM(lastsell_amount) as lastsell_amount'))
                                        ->groupBy('invoice_no')
                                        ->first();
                                        $invoicepayment = \App\Admin_model\Customerpayment::where('invoice_no', $row[0]->invoice_no)->where('payment_date',$row[0]->selldate)->first();
                                        //dd($invoicepayment)
                                    @endphp
                                    <tr>
                                        <td>{{ $sl}}</td>
                                        <td>{{ $row[0]->selldate}}</td>
                                        <td>{{ $row[0]->invoice_no}}</td>
                                        <td>{{ $row[0]->customer->customer_name}}</td>
                                        <td>{{ round($invoicecalc->total_sellprice)}}</td>
                                        <td>{{ round($invoicecalc->sell_cost)}}</td>
                                        <td>{{ round($invoicecalc->sell_discount)}}</td>
                                        <td>{{ round($invoicecalc->lastsell_amount)}}</td>
                                        <td>{{ round(@$invoicepayment->pay_amount)}}</td>
                                        <td>{{round($invoicecalc->lastsell_amount - @$invoicepayment->pay_amount)}}</td>
                                        <td><a class="btn btn-danger btn-sm" href="{{route('sellorder.delete',$row[0]->invoice_no)}}" id="delete" role="button">Delete</a>
                                        </td>
                                        <td>
                                            <a href="{{route('Order_invoice.Print',$row[0]->invoice_no)}}" target="_blank" > <img src="{{ URL::to('Media/icon/print_icon.png') }}" width="30px;"></a>
                                        </td>
                                    </tr>
                                    <?php $sl++; ?>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addcustomer" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Add Customer</h4>
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
                    <form action="{{ route('Customer.store') }}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Showroom Name">Customer Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="customer_name" class="form-control" placeholder="Customer Name" required="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Address">Address</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="address" class="form-control" id="address_add" placeholder="Address" >
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Contact">Contact</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="mobile" class="form-control" id="mobile_add" placeholder="Contact" required="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Contact">Previous Ledger</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="previus_ledger" class="form-control"  placeholder="Previous Ledger">
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
    <script src="{{ asset('js/Order/order.js') }}"></script>
@endsection


