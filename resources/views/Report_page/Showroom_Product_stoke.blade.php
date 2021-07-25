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
                                            <form action="{{route('category_Brand_filter')}}" method="GET">
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
                                        <table class="table table-hover" id="ul-contact-list" >
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>SL</th>
                                                <th>Date</th>
                                                <th>ID</th>
                                                <th>Product</th>
                                                <th>Symbol</th>
                                                <th>Category</th>
                                                <th>Brand</th>
                                                <th>Quantity</th>
                                                <th>Buy Price</th>
                                                <th>Total</th>
                                                <th>Sell Price</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php use Illuminate\Support\Facades\Cache;$sl = 1; ?>
                                                @foreach($productstoke as $row)
                                                    <tr>
                                                        <td>{{$sl}}</td>
                                                        <td>{{$row->purchase_date}}</td>
                                                        <td>{{$row->product_id}}</td>
                                                        <td>{{$row->product->product_name}}</td>
                                                        <td>{{$row->attribute}}</td>
                                                        <td>{{$row->product->categorie->category_name}}</td>
                                                        <td>{{$row->product->brand->brand_name}}</td>
                                                        <td>{{$row->rest_qty}}</td>
                                                        <td>{{$row->buy_price}}</td>
                                                        <td>{{$row->rest_qty * $row->buy_price}}</td>
                                                        <td>{{$row->sell_price}}</td>
                                                    </tr>
                                                    <?php $sl++; ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="text-center">
                                            {{ $productstoke->links() }}
                                        </div>
                                    </div>
                                    <?php
                                    $recive = Cache::get("Showroom_Recive_Cash");

                                    if($recive) {
                                    ?>
                                    <a href="{{route('showroomcashrecive.print')}}" class="btn btn-primary btn-md" target="_blank" style="float: right">Print</a>
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

