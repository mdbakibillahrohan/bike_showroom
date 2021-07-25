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
                            <div class="card text-center">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>SL</th>
                                                <th>Dealer</th>
                                                <th>Bike ID</th>
                                                <th>Bike</th>
                                                <th>Quantity</th>
                                                <th>Buy Amount</th>
                                                <th>Total Amount</th>
                                                <th>Total Sell</th>
                                                <th>Stoke Qty</th>
                                                <th>Stoke Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $sl = 1; ?>
                                            @foreach ($purchesh as $row)
                                                @php
                                                    $bikedata = \App\Bike_Model\Bikepurchase::where('bike_id',$row->bike_id)->first();
                                                    $bikesell = \App\Bike_Model\Bikesell::select('bike_id', DB::raw('SUM(sell_price) as last_total_amount'), DB::raw('SUM(quantity) as quantitysell'))
            ->groupBy('bike_id')
            ->where('bike_id',$row->bike_id)
            ->first();

                                                @endphp
                                                <tr>
                                                    <td>{{ $sl}}</td>
                                                    <td>{{ $bikedata->supplier->suplier_name}}</td>
                                                    <td>{{ $row->bike_id}}</td>
                                                    <td>{{ $bikedata->bike->name}}</td>
                                                    <td>{{ $row->quantity}}</td>
                                                    <td>{{ $bikedata->buy_price}}</td>
                                                    <td>{{ $bikedata->buy_price * $row->quantity}}</td>
                                                    <td>{{ $bikesell->last_total_amount}}</td>
                                                    <td>{{ $row->rest_qty}}</td>
                                                    <td>{{ $bikedata->buy_price * $row->rest_qty}}</td>
                                                </tr>
                                                <?php $sl++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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


@endsection


