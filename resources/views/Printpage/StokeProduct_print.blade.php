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
                                        <th>ID</th>
                                        <th>Product</th>

                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Symbol</th>
                                        <th>Quantity</th>
                                        <th>Buy Price</th>
                                        <th>Total</th>
                                        <th>Sell Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php use Illuminate\Support\Facades\Cache;$sl = 1;?>
                                <?php
                                for($x = 1; $x <= count($productstoke); $x++){
                                ?>
                                <tr>
                                    <td>{{$sl}}</td>
                                    <td>{{$productstoke[$x]['purchase_date']}}</td>
                                    <td>{{$productstoke[$x]['product_id']}}</td>
                                    <td>{{$productstoke[$x]['product_name']}}</td>

                                    <td>{{$productstoke[$x]['category_name']}}</td>
                                    <td>{{$productstoke[$x]['brand_name']}}</td>
                                    <td>{{$productstoke[$x]['attribute']}}</td>
                                    <td>{{$productstoke[$x]['rest_qty']}}</td>
                                    <td>{{$productstoke[$x]['buy_price']}}</td>
                                    <td class="buy">{{$productstoke[$x]['buy_price'] * $productstoke[$x]['rest_qty']}}</td>
                                    <td>{{$productstoke[$x]['sell_price']}}</td>
                                </tr>
                                <?php
                                }

                                ?>

                                <?php $sl ++;?>
                                <tr>
                                    <td colspan="9" style="font-size: 14px; font-weight: bold; text-align: right;" class="totalbuy"> </td>
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
            tally('td.totalbuy','td.buy:eq(' , "Total Buy Product : ");
            tally('td.allpay','td.buy:eq(' , "Total Buy Amount : ");

        });
    </script>
@endsection
