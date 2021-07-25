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
                                            <form action="" method="GET">

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

{{--                                                    <div class="col-sm-2">--}}
{{--                                                        <button type="submit" class="btn btn-primary btn-md">Search</button>--}}
{{--                                                    </div>--}}

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>SL</th>
                                                <th>Date</th>
                                                <th>Re-Invoice</th>
                                                <th>Sell-Invoice</th>
                                                <th>Customer</th>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>Deducted</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php use Illuminate\Support\Facades\Cache;$sl = 1; ?>

                                            @foreach ($returnorder as $row)
                                                <tr>
                                                    <td>{{ $sl}}</td>
                                                    <td>{{$row->date}}</td>
                                                    <td>{{$row->return_invoice}}</td>
                                                    <td>{{$row->sell_invoice}}</td>
                                                    <td>{{$row->customer->customer_name}}</td>
                                                    <td>{{$row->product->product_name}}</td>
                                                    <td>{{$row->sellprice}}</td>
                                                    <td>{{$row->quantity}}</td>
                                                    <td>{{$row->quantity * $row->sellprice}}</td>
                                                    <td>{{$row->deducted}}</td>
                                                    <td>{{$row->return_cash}}</td>
                                                    <td>
                                                        <?php
                                                        $status = $row->return_status;
                                                        if ($status==1){
                                                        ?>
                                                        <a class="badge badge-success m-2 p-2" href=""><?php
                                                            $status = $row->return_status;
                                                            if ($status==1){echo "Done";}else{echo "Pending";}
                                                            ?></a>
                                                        <?php
                                                        }else{
                                                        ?>
                                                        <a class="badge badge-primary m-2 p-2 updatereturn" id="{{$row->id}}" href="#"><?php
                                                            $status = $row->return_status;
                                                            if ($status==1){echo "Done";}else{echo "Pending";}
                                                            ?></a>
                                                        <?php
                                                        }
                                                        ?>

                                                    </td>
                                                </tr>
                                                <?php $sl++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="text-center">
                                            {{ $returnorder->links() }}
                                        </div>
                                    </div>
{{--                                    <?php--}}
{{--                                    $recive = Cache::get("totalpurchesh_search");--}}
{{--                                    if($recive) {--}}
{{--                                    ?>--}}
{{--                                    <a href="{{route('product_purchesh_search_print')}}" class="btn btn-primary btn-md" target="_blank" style="float: right">Print</a>--}}
{{--                                    <?php--}}
{{--                                    }--}}
{{--                                    ?>--}}
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


    <div class="modal fade" id="return_order_model" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Return Order Update</h4>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="" class="returnupdate_data" method="POST"  enctype="multipart/form-data">

                        @method('PUT')
                        @csrf

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for=""> Return Type :</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" name="returntype" id="" required>
                                        <option value="">Select Type</option>
                                        <option value="1">Cash Return</option>
                                        <option value="0">Wrong Data</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('pagescript')
    <script src="{{ asset('js/Order/return_order.js') }}"></script>

    <script>
        $(function(){
            $(".updatereturn").click(function(event) {
                var returnid = $(this).attr('id');
                $('.returnupdate_data').attr('action', '/Return_order/'+returnid);
                $("#return_order_model").modal('show');
            });
        });

    </script>
@endsection




