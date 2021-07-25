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
                                            <form action="{{route('product_purches_search')}}" method="GET">
                                                {{ csrf_field() }}
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
                                                <th>ID</th>
                                                <th>Invoice</th>
                                                <th>Date</th>
                                                <th>Product</th>
                                                <th>Symb</th>
                                                <th>Quantity</th>
                                                <th>Buy</th>
                                                <th>Amount</th>
                                                <th>Cost</th>
                                                <th>Dis</th>
                                                <th>Total</th>
                                                <th>Qty_Last</th>
                                                <th>Sell</th>
                                                <th>View</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php use Illuminate\Support\Facades\Cache;$sl = 1; ?>

                                            @foreach ($productdetails as $row)
                                                <tr>
                                                    <td>{{ $sl}}</td>
                                                    <td>{{$row->product_id}}</td>
                                                    <td>{{$row->invoice_no}}</td>
                                                    <td>{{$row->purchase_date}}</td>
                                                    <td>{{$row->product->product_name}}</td>
                                                    <td>{{$row->attribute}}</td>
                                                    <td>{{$row->quantity}}</td>
                                                    <td>{{$row->buy_price}}</td>
                                                    <td>{{$row->sub_total_buy}}</td>
                                                    <td>{{$row->buy_cost}}</td>
                                                    <td>{{$row->discount}}</td>
                                                    <td>{{$row->actual_buy}}</td>
                                                    <td>{{$row->rest_qty}}</td>
                                                    <td>{{$row->sell_price}}</td>
                                                    <td>
                                                        <a href="{{route('Purchase_invoice.Details',$row->invoice_no)}}" class="btn btn-sm btn-success">Invoice</a>
                                                    </td>
                                                </tr>
                                                <?php $sl++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="text-center">
                                            {{ $productdetails->links() }}
                                        </div>
                                    </div>
                                    <?php
                                    $recive = Cache::get("totalpurchesh_search");
                                    if($recive) {
                                    ?>
                                    <a href="{{route('product_purchesh_search_print')}}" class="btn btn-primary btn-md" target="_blank" style="float: right">Print</a>
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


