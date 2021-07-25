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

                                        <input type="hidden" id="customer_status">
                                        <input type="hidden" id="sellinvoice">
                                        <input type="hidden" id="productid">
                                        <input type="hidden" id="checkvalue">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Sale Date : <span class="tx-danger"> *</span></label>
                                                            <?php  use Illuminate\Support\Facades\Cache;$n_dat= date("Y-m-d"); ?>
                                                            <input type="date" class="form-control" name="" id="returndate" value="{{$n_dat}}" required style="width: 167px;font-size: 15px;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Customer : <span class="tx-danger"> *</span></label>
                                                            <select name="customerid" class="form-control" id="customeriddata">
                                                                <option value="">Select Customer</option>
                                                                @foreach ($customer as $data)
                                                                    <option value="{{$data->id}}">{{$data->customer_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Sell Product List: <span class="tx-danger"> *</span></label>
                                                            <input autofocus="autofocus" class="form-control newtag returndatacheck" id="tags" placeholder="Product Name" required tabindex="1">
                                                            <input type="hidden" class="form-control" id="tagsname" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Barcode Search : <span class="tx-danger"> *</span></label>
                                                            <input type="text" class="form-control" name="bercodeinput" id="bercode_input" value="" placeholder="Input Bercode" style="padding-left: 54px;"><img src="{{asset('Media/icon/barcode.png')}}" alt="" style="width: 38px; margin-top: -60px; margin-left: -218px;">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Sell Date : <span class="tx-danger"> *</span></label>
                                                            <input type="text" class="form-control" name="" id="selldate" value="" placeholder="Sell Date" disabled style="font-size: 14px">
                                                        </div>
                                                    </div>

                                                </div>

                                                <hr style="display: block; height: 2px; border: 0; border-top: 4px solid rebeccapurple; margin: 1em 0; padding: 0;  margin-top: -4px;">


                                                <div class="row">
                                                    <div class="col-md-12">

                                                        <div class="row">

                                                            <div class="col-md-9">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label">Sell Qty: <span class="tx-danger"> *</span></label>
                                                                            <input type="text" class="form-control" name="sale_qty" id="sellquantity" placeholder="Sell Qty" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label">Sell Amount : <span class="tx-danger"> *</span></label>
                                                                            <input type="text" class="form-control" name="" id="subtotal" placeholder="Sell Amount" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label">Sell Price: <span class="tx-danger"> *</span></label>
                                                                            <input type="text" class="form-control " name="sale_price" id="sellprice" placeholder="Sell Price" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label">Return Qty: <span class="tx-danger"> *</span></label>
                                                                            <input type="text" class="form-control returndatacheck" name="sale_price" id="return_qty" placeholder="Return Quantity">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label">Return Price: <span class="tx-danger"> *</span></label>
                                                                            <input type="text" class="form-control returndatacheck" name="return_price" id="returnprice" placeholder="Return Price">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label">Return Amount: <span class="tx-danger"> *</span></label>
                                                                            <input type="text" class="form-control returndatacheck" name="returnamount_total" id="returnamounttotal" placeholder="Return Amount" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-1" style="margin-top: 30px;">
                                                                        <button type="button" id="addbtn" class="glyphicon glyphicon-plus btn-primary btn-sm" aria-label="">+
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 table-responsive">
                                                                    <table class="table table-striped table-bordered" id="item_list">
                                                                        <thead  class="thead">
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Product</th>
                                                                            <th>Price </th>
                                                                            <th>Quantity</th>
                                                                            <th>Total Sell</th>
                                                                            <th>Remove</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="accountsection" style="background: #ff008152; margin-top: 0px; margin-bottom: 10px; padding: 4px; border-radius:5px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group-inner">
                                                                                <div class="row">
                                                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                                                        <label class="login2 pull-right pull-right-pro" style="font-size: 11px;">Sub Total :</label>
                                                                                    </div>
                                                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                                                                        <input type="text" class="form-control" id="subtotal_data" disabled="" style="font-weight: bold" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group-inner">
                                                                                <div class="row">
                                                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                                                        <label class="login2 pull-right pull-right-pro" style="font-size: 11px;">Customer Ac :</label>
                                                                                    </div>
                                                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                                                                        <input type="text" class="form-control" name="cost" id="customer_account" style="font-weight: bold" disabled/>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group-inner">
                                                                                <div class="row">
                                                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                                                        <label class="login2 pull-right pull-right-pro" style="font-size: 11px;">Lase cash :</label>
                                                                                    </div>
                                                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                                                                        <input type="text" class="form-control returndatacheck" name="discount" id="deducted_cash" style="font-weight: bold" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="form-group-inner">
                                                                                <div class="row">
                                                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                                                        <label class="login2 pull-right pull-right-pro" style="font-size: 11px;"> Total Amount: </label>
                                                                                    </div>
                                                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                                                                        <input type="text" class="form-control" id="grandtotal" disabled="" style="font-weight: bold" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group-inner">
                                                                                <div class="row">
                                                                                    <div class="col-md-8">
                                                                                        <label class="login2 pull-right pull-right-pro" style="font-size: 11px;">Customer Adjust :</label>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <input type="checkbox" class="form-check-input" id="checkval" name="cash_adjust" value="">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="form-actions text-center">
                                        <button class="btn btn-primary pull-center" id="return_submit_btn">Submit</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <div class="table-responsive m-b-40">
                                        <table class="table table-striped table-data3 data-table1">
                                            <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Date</th>
                                                <th>Invoice</th>
                                                <th>Customer</th>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>Deducted</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php //dd($returnorder) ?>
                                            <?php $sl = 1; ?>
                                            @foreach ($returnorder as $row)

                                                <tr>
                                                    <td>{{ $sl}}</td>
                                                    <td>{{$row->date}}</td>
                                                    <td>{{$row->return_invoice}}</td>
                                                    <td>{{$row->customer->customer_name}}</td>
                                                    <td>{{$row->product->product_name}}</td>
                                                    <td>{{$row->sellprice}}</td>
                                                    <td>{{$row->quantity}}</td>
                                                    <td>{{$row->quantity * $row->sellprice}}</td>
                                                    <td>{{$row->deducted}}</td>
                                                    <td>{{$row->return_cash}}</td>
                                                    <td>
                                                        <?php
                                                        $status = $row->return_status;
                                                        if ($status==1){
                                                        ?>
                                                            <a class="badge badge-success m-2 p-2" href=""><?php
                                                            $status = $row->return_status;
                                                            if ($status==1){echo "Done";}else{echo "Pending";}
                                                            ?></a>
                                                        <?php
                                                        }else{
                                                            ?>
                                                            <a class="badge badge-primary m-2 p-2 updatereturn" id="{{$row->id}}" href="#"><?php
                                                            $status = $row->return_status;
                                                            if ($status==1){echo "Done";}else{echo "Pending";}
                                                            ?></a>
                                                            <?php
                                                        }
                                                        ?>

                                                    </td>
                                                </tr>
                                                <?php $sl++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="text-center">
                                            {{ $returnorder->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div class="modal fade" id="return_order_model" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Return Order Update</h4>
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

                    <form action="" class="returnupdate_data" method="POST"  enctype="multipart/form-data">

                        @method('PUT')
                        @csrf

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for=""> Return Type :</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" name="returntype" id="" required>
                                        <option value="">Select Type</option>
                                        <option value="1">Cash Return</option>
                                        <option value="0">Wrong Data</option>
                                    </select>
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
    <script src="{{ asset('js/Order/return_order.js') }}"></script>

    <script>
        $(function(){
            $(".updatereturn").click(function(event) {
                var returnid = $(this).attr('id');
                $('.returnupdate_data').attr('action', '/Return_order/'+returnid);
                $("#return_order_model").modal('show');
            });
        });

    </script>
@endsection


