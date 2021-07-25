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

                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>SL</th>
                                                <th>Customer</th>
                                                <th>Address</th>
                                                <th>Mobile</th>
                                                <th>Guarantor</th>
                                                <th>Bike</th>
                                                <th>Purchase</th>
                                                <th>Interest</th>
                                                <th>Total Due</th>
                                                <th>Total Payment</th>
                                                <th>EMI</th>
                                                <th>Last Due</th>
                                                <th>View</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $sl = 1; ?>
                                                @foreach ($accounts as $row)
                                                    @php
                                                        $installmentdata = \App\Bike_Model\Installment::where('bikecustomer_id',$row->id)
                                                ->select('bikecustomer_id', DB::raw('SUM(blanch) as blanch'), DB::raw('SUM(pay_amount) as pay_amount'))
                                                ->groupBy('bikecustomer_id')
                                                ->first();
                                                        $install_count = \App\Bike_Model\Installment::where('bikecustomer_id',$row->id)->where('status',0)->get();
                                                        $count = count($install_count);
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $sl}}</td>
                                                        <td>{{ $row->customer_name}}</td>
                                                        <td>{{ $row->address}}</td>
                                                        <td>{{ $row->mobile}}</td>
                                                        <td>{{ $row->guarantorname}}</td>
                                                        <td>{{ $row->bikesells->bike->name}}</td>
                                                        <td>{{ $row->bikesells->last_total_amount}}</td>
                                                        <td>{{ $row->bikesells->interest}}</td>
                                                        <td>{{ $row->bikesells->last_total_amount + $row->bikesells->interest}}</td>
                                                        <td>{{ $row->bikesells->cashpayment + $installmentdata->pay_amount}}</td>

                                                        <td>{{ $count}}</td>
                                                        <td>{{ $installmentdata->blanch}}</td>

                                                        <td>
                                                            <a href="{{route('customer_view_details',$row->id)}}" class="btn btn-sm btn-success">View</a>
                                                        </td>
                                                    </tr>
                                                    <?php $sl++; ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center">
                                        {{ $accounts->links() }}
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


