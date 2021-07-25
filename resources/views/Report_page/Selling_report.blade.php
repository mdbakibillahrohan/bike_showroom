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
                                            <form action="{{route('category_Brand_orderdata')}}" method="GET">
                                                @csrf

                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <select class="form-control" name="categorie_id" id="categorydata_id">
                                                                <option value=""> Select Category</option>
                                                                @foreach($category as $data)
                                                                    <option value="{{$data->id}}">{{$data->category_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <select class="form-control" name="brand_id" id="brand_id">
                                                                <option value=""> Select Brand</option>
                                                                @foreach($brand as $row)
                                                                    <option value="{{$row->id}}"> {{$row->brand_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input class="form-control" placeholder="From date" type="date" name="startdate" name="fromdate" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input class="form-control" placeholder="To date" type="date" name="enddate" name="todate" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-1">
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
                                                <th>Category</th>
                                                <th>Brand</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                                <th>Cost</th>
                                                <th>Discount</th>
                                                <th>Actual</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php use Illuminate\Support\Facades\Cache;$sl = 1; ?>
                                                @foreach($orderdata as $row)
                                                    <tr>
                                                        <td>{{$sl}}</td>
                                                        <td>{{$row->selldate}}</td>
                                                        <td>{{$row->invoice_no}}</td>
                                                        <td>{{$row->product->product_name}}</td>
                                                        <td>{{$row->product->categorie->category_name}}</td>
                                                        <td>{{$row->product->brand->brand_name}}</td>
                                                        <td>{{$row->quantity}}</td>
                                                        <td>{{$row->sellprice}}</td>
                                                        <td>{{$row->total_sellprice}}</td>
                                                        <td>{{$row->sell_cost}}</td>
                                                        <td>{{$row->sell_discount}}</td>
                                                        <td>{{$row->lastsell_amount}}</td>
                                                    </tr>
                                                    <?php $sl++; ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="text-center">
                                            {{ $orderdata->links() }}
                                        </div>
                                    </div>
                                    <?php
                                    $recive = Cache::get("OrderreportSearchdata");

                                    if($recive) {
                                    ?>
                                    <a href="{{route('OrderSearchData.print')}}" class="btn btn-primary btn-md" target="_blank" style="float: right">Print</a>
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

