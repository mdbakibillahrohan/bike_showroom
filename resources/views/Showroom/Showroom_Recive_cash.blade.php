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
                                            <form action="{{route('showroom.recivecash_search')}}" method="GET">
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
                                                <th>Customer</th>
                                                <th>Amount</th>
                                                <th>Cost By</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php use Illuminate\Support\Facades\Cache;$sl = 1; ?>
                                                @foreach($recivecash as $row)
                                                    <tr>
                                                        <td>{{$sl}}</td>
                                                        <td>{{$row->received_date}}</td>
                                                        <td>{{ $row->invoice_no }}</td>
                                                        <td>{{ $row->customer->customer_name }}</td>
                                                        <td>{{ $row->received}}</td>
                                                        <td>{{ $row->user->name}}</td>

                                                    </tr>
                                                    <?php $sl++; ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="text-center">
                                            {{ $recivecash->links() }}
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

