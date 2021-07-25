@extends('Purchase_layouts.Purchase_master_layout')
@section('content')

    <div class="app-admin-wrap layout-sidebar-large">
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="main-content">
                @include('Common_header_footer.pagetitle')
                <div class="separator-breadcrumb border-top"></div>
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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="{{route('single_product_purches_search')}}" method="GET">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="productid" value="{{$singleProduct[0]->product_id}}">
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                        <div class="row">
                                                            <div class="col-md-9 col-xs-9 col-sm-9 col-lg-9 col-9">
                                                                <div class="form-group">
                                                                    <input class="form-control" placeholder="From date" type="date" name="startdate" name="fromdate" autocomplete="off">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                        <div class="row">
                                                            <div class="col-md-9 col-xs-9 col-sm-9 col-lg-9 col-9">
                                                                <div class="form-group">
                                                                    <input class="form-control" placeholder="To date" type="date" name="enddate" name="todate" autocomplete="off">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <button type="submit" class="btn btn-primary btn-md">Search</button>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>SL</th>
                                                <th>Date</th>
                                                <th>Product</th>
                                                <th>Code</th>
                                                <th>Symbol</th>
                                                <th>Quantity</th>
                                                <th>Buy</th>
                                                <th>Amount</th>
                                                <th>Cost</th>
                                                <th>Discount</th>
                                                <th>Amount</th>
                                                <th>Stoke</th>
                                                <th>Sell</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php use Illuminate\Support\Facades\Cache;$sl = 1; ?>

                                            @foreach ($barcodedata as $row)
                                                <tr>
                                                    <td>{{ $sl}}</td>
                                                    <td>{{$row->purchase->purchase_date}}</td>
                                                    <td>{{$row->product->product_name}}</td>
                                                    <td>{{$row->barcode}}</td>
                                                    <td>{{$row->purchase->attribute}}</td>
                                                    <td>{{$row->purchase->quantity}}</td>
                                                    <td>{{$row->purchase->buy_price}}</td>
                                                    <td>{{$row->purchase->sub_total_buy}}</td>
                                                    <td>{{$row->purchase->buy_cost}}</td>
                                                    <td>{{$row->purchase->discount}}</td>
                                                    <td>{{$row->purchase->actual_buy}}</td>
                                                    <td>{{$row->purchase->rest_qty}}</td>
                                                    <td>{{$row->purchase->sell_price}}</td>
                                                </tr>
                                                <?php $sl++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="text-center">
                                            {{ $singleProduct->links() }}
                                        </div>
                                    </div>
                                    <?php
                                    $recive = Cache::get("totalpurchesh_search");

                                    if($recive) {
                                    ?>
                                    <a href="{{route('single_purchesh_search_print')}}" class="btn btn-primary btn-md" target="_blank" style="float: right">Print</a>
                                    <?php
                                    }
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>



@endsection


@section('pagescript')
    <script type="text/javascript">
        $('#searchproduct').on('keyup',function(){
            $value = $(this).val();
            var slag = $("#slag").val();
            $.ajax({
                type : 'get',
                url : '{{route('product.purcheshdata')}}',
                data:{'search':$value},
                success:function(data){
                    $('tbody').html(data);
                }
            });
        })

    </script>
@endsection


