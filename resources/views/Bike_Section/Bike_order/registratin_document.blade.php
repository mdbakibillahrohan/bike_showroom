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
                                                <th>Bike</th>
                                                <th>Registration</th>
                                                <th>Amount</th>
                                                <th>Payment</th>
                                                <th>Blanch</th>
                                                <th>Delivery</th>
                                                <th>Status</th>
                                                <th>Update</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $sl = 1; ?>
                                                @foreach ($registratin as $row)
                                                    <tr>
                                                        <td>{{ $sl}}</td>
                                                        <td>{{ $row->bike->bikesells->bikecustomer->customer_name}}</td>
                                                        <td>{{ $row->bike->name}}</td>
                                                        <td>{{ $row->registrationtype}}</td>
                                                        <td>{{ $row->registrationamount}}</td>
                                                        <td>{{ $row->payment - $row->vatamount}}</td>
                                                        <td>{{ $row->due_amount}}</td>
                                                        <td>{{ $row->delivery_date}}</td>
                                                        @php
                                                          $statusnew =  $row->status;
                                                            if ($statusnew==0){
                                                                $status = "Pending";
                                                            }else{
                                                               $status = "Done";
                                                            }
                                                        @endphp
                                                        <td>{{$status}}</td>

                                                        <td>
                                                            <a href="" class="btn btn-sm btn-success">Update</a>
                                                        </td>
                                                    </tr>
                                                    <?php $sl++; ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center">
                                        {{ $registratin->links() }}
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


