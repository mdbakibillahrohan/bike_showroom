@extends('Purchase_layouts.Purchase_master_layout')
@section('content')

    <div class="app-admin-wrap layout-sidebar-large">
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="main-content">
                @include('Common_header_footer.pagetitle')
                <div class="separator-breadcrumb border-top"></div>
                <section class="contact-list">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="card text-left">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="{{route('showroom.profitsearch')}}" method="GET">
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
                                        <table class="table table-hover" id="" style="width:100%">
                                            <thead class="thead-dark">
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
                                                @php
                                                    $inv = explode("-", $row->invoice_no);
                                                    if ($inv[0]=="BK"){
                                                        $productdata = \App\Bike_Model\Bike::where('id',$row->product_id)->first();
                                                        $productname = $productdata->name;
                                                    }else{
                                                        $productdata = \App\Product_model\Product::where('id',$row->product_id)->first();
                                                        $productname = $productdata->product_name;
                                                    }
                                                @endphp

                                                <tr>
                                                    <td>{{$sl}}</td>
                                                    <td>{{$row->selldate}}</td>
                                                    <td>{{$row->invoice_no}}</td>
                                                    <td>{{$productname}}</td>
                                                    <td>{{$row->buy_price}}</td>
                                                    <td>{{$row->sell_price}}</td>
                                                    <td>{{$row->quantity}}</td>
                                                    <td>{{$row->total_buy_amount}}</td>
                                                    <td>{{$row->total_sell_amount}}</td>
                                                    <td>{{$row->total_sell_amount - $row->total_buy_amount}}</td>
                                                </tr>

                                                <?php $sl++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="text-center">
                                            {{ $profit->links() }}
                                        </div>
                                    </div>
                                    <?php
                                    $recive = Cache::get("Showroom_profit");

                                    if($recive) {
                                    ?>
                                    <a href="{{route('showroomprofit.print')}}" class="btn btn-primary btn-md" target="_blank" style="float: right">Print</a>
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

