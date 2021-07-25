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
                    <div>
                        <strong>Supplier</strong>
                    </div>
                    ------------------------
                    <div><strong> Name :  </strong>{{$singlePurchase->supplier->suplier_name}}</div>
                    <div><strong>Previous Blanch : </strong> {{$previus_invoice->accounts}}</div>
                    <div><strong>Last Blanch : </strong> {{$last_invoice->accounts}} </div>
                </div>
                <div class="col-md-4">
                    <h5 class="text-align=center">Invoice </h5>
                </div>
                <div class="col-md-4">
                    <div><strong>Buy Amount : </strong> {{$singlePurchase->sub_total_buy}} </div>
                    <div><strong>Discount : </strong>{{$singlePurchase->discount}} </div>
                    <div><strong>Cost Amount : </strong> {{$singlePurchase->buy_cost}}</div>
                    <div><strong>Actual Buy : </strong> {{$singlePurchase->actual_buy}}</div>
                    <div><strong>Invoice Payment : </strong> {{@$supllierpayment->pay_amount}}</div>
                    <div><strong>Blanch : </strong>{{$singlePurchase->actual_buy - @$supllierpayment->pay_amount}} </div>
                </div>
            </div>
            <div class="row orderdata">
                <div class="table-responsive">
                    <table border="1" cellspacing="1" cellpadding="1" style="width:100%">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Product</th>
                            <th>Symbol</th>
                            <th>Quantity</th>
                            <th>Buy</th>
                            <th>Cost</th>
                            <th>Discount</th>
                            <th>Payable</th>
                            <th>Sell price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sl=1;?>
                        @foreach ($InvoicePurchase as $row)
                            <tr>
                                <td>{{ $sl}}</td>
                                <td>{{$row->product->product_name}}</td>
                                <td>{{$row->attribute}}</td>
                                <td>{{ $row->quantity}}</td>
                                <td>{{ $row->buy_price}}</td>
                                <td>{{ $row->buy_cost}}</td>
                                <td>{{ $row->discount}}</td>
                                <td class="buy">{{ $row->actual_buy}}</td>
                                <td>{{ $row->sell_price}}</td>
                            </tr>
                            <?php $sl++; ?>
                        @endforeach
                        <tr>
                            <td colspan="7" style="font-size: 14px; font-weight: bold; text-align: right;" class="allbuy"> </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

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
            tally('td.allbuy','td.buy:eq(' , "Total Buy Amount : ");
        });
    </script>
@endsection
