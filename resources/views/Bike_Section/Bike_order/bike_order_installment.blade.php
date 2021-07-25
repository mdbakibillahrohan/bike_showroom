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
                                        <table class="table table-hover" id="ul-contact-list" style="letter-spacing: -0.2px;font-size: 13px;">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>SL</th>
                                                <th>Bike</th>
                                                <th>Customer</th>
                                                <th>Amount</th>
                                                <th>Payment</th>
                                                <th>Interest</th>
                                                <th>Due</th>
                                                <th>Installment</th>
                                                <th>Inst-Amount</th>
                                                <th>Inst-Due</th>
                                                <th>Details</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $sl = 1; ?>
                                            @foreach ($installment as $row)
                                                @php
                                                    $installmentcount = \Illuminate\Support\Facades\DB::table('installments')->where('bikecustomer_id',$row->bikecustomer_id)->where('status', 0)->get();

                                                @endphp
                                                <tr>
                                                    <td>{{ $sl}}</td>
                                                    <td>{{ $row->bikecustomer->bikesells->bike->name}}</td>
                                                    <td>{{ $row->bikecustomer->customer_name}}</td>
                                                    <td>{{ $row->bikecustomer->bikesells->last_total_amount}}</td>
                                                    <td class="pay">{{ $row->bikecustomer->bikesells->cashpayment}}</td>
                                                    <td>{{ $row->bikecustomer->bikesells->interest}}</td>
                                                    <td>{{ $row->bikecustomer->bikesells->last_due_amount}}</td>
                                                    <td>{{ count($installmentcount)}}</td>
                                                    <td>{{ $row->bikecustomer->bikesells->installmentamount}}</td>
                                                    <td class="balan">{{ $row->blanch}}</td>
                                                    <td>
                                                        <a href="{{route('customer.installment',$row->bikecustomer_id)}}" class="btn btn-sm btn-success">View</a>
                                                    </td>
                                                </tr>
                                                <?php $sl++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center">
                                        {{ $installment->links() }}
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




