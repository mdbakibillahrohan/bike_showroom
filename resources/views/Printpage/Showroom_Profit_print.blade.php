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
                    <div class="col">
                        <div class="printhead">
                            <h4>{{$showroomdata->showroom_name}}</h4>
                            <h6>{{$showroomdata->showroom_details}}</h6>
                            <h6>{{$showroomdata->address.", ".$showroomdata->mobile}}</h6>
                        </div>
                    </div>
                </div>
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
                                        <th>Invoice</th>
                                        <th>Product</th>
                                        <th>Buy Price</th>
                                        <th>Sell Price</th>
                                        <th>Qty</th>
                                        <th>Total Buy</th>
                                        <th>Total sell</th>
                                        <th>Profit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $sl = 1; ?>
                                @foreach($profit as $row)
                                    <tr>
                                        <td>{{$sl}}</td>
                                        <td>{{$row->selldate}}</td>
                                        <td>{{$row->invoice_no}}</td>
                                        <td>{{$row->product->product_name}}</td>
                                        <td>{{$row->buy_price}}</td>
                                        <td>{{$row->sell_price}}</td>
                                        <td>{{$row->quantity}}</td>
                                        <td>{{$row->total_buy_amount}}</td>
                                        <td>{{$row->total_sell_amount}}</td>
                                        <td class="profit">{{$row->total_sell_amount - $row->total_buy_amount}}</td>
                                    </tr>

                                    <?php $sl++; ?>
                                @endforeach
                                <tr>
                                    <td colspan="10" style="font-size: 14px; font-weight: bold; text-align: right;" class="totalprofit"> </td>
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
            tally('td.totalprofit','td.profit:eq(' , "Total Profit : ");
            tally('td.allpay','td.buy:eq(' , "Total Buy Amount : ");

        });
    </script>
@endsection
