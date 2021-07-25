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
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-4">--}}
{{--                                            <div class="breadcome-heading">--}}
{{--                                                <form role="search" class="sr-input-func">--}}
{{--                                                    <input type="text" placeholder="Search Product" class="search-int form-control" id="searchproduct">--}}
{{--                                                    <a href="#"><i class="search-icon text-muted i-Magnifi-Glass1"></i></a>--}}
{{--                                                </form>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>SL</th>
                                                <th>Date</th>
                                                <th>Type</th>
                                                <th>Customer</th>
                                                <th>Bike</th>
                                                <th>Payment</th>
                                                <th>Receive</th>
                                                <th>View</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $sl = 1; ?>
                                            @foreach ($payment as $row)
                                                <tr>
                                                    <td>{{ $sl}}</td>
                                                    <td>{{ $row->payment_date}}</td>
                                                    <td>{{ $row->payment_type}}</td>
                                                    <td>{{ $row->bikecustomer->customer_name}}</td>
                                                    <td>{{ $row->bike->name}}</td>
                                                    <td>{{ $row->Pay_amount}}</td>
                                                    <td>{{ $row->bike->user->name}}</td>
                                                    <td>
                                                        <a href="" class="btn btn-sm btn-success">View</a>
                                                    </td>
                                                </tr>
                                                <?php $sl++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center">
                                        {{ $payment->links() }}
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


