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
                                        <th>Invoice</th>
                                        <th>Date</th>
                                        <th>Product</th>
                                        <th>Code</th>
                                        <th>Symbol</th>
                                        <th>Quantity</th>
                                        <th>Buy</th>
                                        <th>Amount</th>
                                        <th>Cost</th>
                                        <th>Discount</th>
                                        <th>Actual Amount</th>
                                        <th>Qty Last</th>
                                        <th>Sell</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $sl = 1; ?>

                                @foreach ($singleProduct as $row)
                                    <tr>
                                        @php
                                            $barcodedata = \App\Admin_model\Barcode::where('purchase_id',$row->id)->first();
                                        @endphp

                                        <td>{{ $sl}}</td>
                                        <td>{{$row->invoice_no}}</td>
                                        <td>{{$row->purchase_date}}</td>
                                        <td>{{$row->product->product_name}}</td>
                                        <td>{{$barcodedata->barcode}}</td>
                                        <td>{{$row->attribute}}</td>
                                        <td class="qty">{{$row->quantity}}</td>
                                        <td>{{$row->buy_price}}</td>
                                        <td>{{$row->sub_total_buy}}</td>
                                        <td>{{$row->buy_cost}}</td>
                                        <td>{{$row->discount}}</td>
                                        <td class="buy">{{round($row->actual_buy)}}</td>
                                        <td>{{$row->rest_qty}}</td>
                                        <td>{{$row->sell_price}}</td>
                                    </tr>

                                    <?php $sl++; ?>
                                @endforeach

                                <tr>
                                    <td colspan="11" style="font-size: 14px; font-weight: bold; text-align: right;" class="alldis"> </td>
                                </tr>
                                <tr>
                                    <td colspan="11" style="font-size: 14px; font-weight: bold; text-align: right;" class="allpay"> </td>
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
            tally('td.alldis','td.qty:eq(' , "Total Buy Product : ");
            tally('td.allpay','td.buy:eq(' , "Total Buy Amount : ");

        });
    </script>
@endsection
