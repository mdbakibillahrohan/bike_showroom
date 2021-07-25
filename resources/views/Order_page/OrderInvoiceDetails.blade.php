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
                                            <div class="breadcome-heading">
                                                <form action="{{route('oderInvoicedata_search')}}" method="GET">
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
                                                            <button type="submit" class="btn btn-primary btn-md">Filter</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>SL</th>
                                                <th>Date</th>
                                                <th>Invoice</th>
                                                <th>Customer</th>
                                                <th>Price</th>
                                                <th>Cost</th>
                                                <th>Discount</th>
                                                <th>Total</th>
                                                <th>Payment</th>
                                                <th>Blanch</th>
                                                <th>View</th>
                                                <th>Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $sl = 1; ?>
                                            @foreach ($neworderdata as $row)

                                                @php
                                                $invoicedata = \App\Order_model\Order::where('invoice_no',$row->invoice_no)->first();
                                                    $invoicepayment = \App\Admin_model\Customerpayment::where('invoice_no', $row->invoice_no)->where('payment_date',$invoicedata->selldate)->first();
                                                @endphp
                                                <tr>
                                                    <td>{{ $sl}}</td>
                                                    <td>{{ $invoicedata->selldate}}</td>
                                                    <td>{{ $row->invoice_no}}</td>
                                                    <td>{{ $invoicedata->customer->customer_name}}</td>
                                                    <td>{{ round($row->total_sellprice)}}</td>
                                                    <td>{{ round($row->sell_cost)}}</td>
                                                    <td>{{ round($row->sell_discount)}}</td>
                                                    <td>{{ round($row->lastsell_amount)}}</td>
                                                    <td>{{ round($invoicepayment->pay_amount)}}</td>
                                                    <td>{{round($row->lastsell_amount - $invoicepayment->pay_amount)}}</td>
                                                    <td>
                                                        <a href="{{route('Order.show',$row->invoice_no)}}" target="_blank" class="btn btn-primary btn-sm" >view</a>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-danger btn-sm" href="{{route('sellorder.delete',$row->invoice_no)}}" id="delete" role="button">Delete</a>
                                                    </td>
                                                </tr>
                                                <?php $sl++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                    $recive = Cache::get("totalorderdata_search");

                                    if($recive) {
                                    ?>
                                    <a href="{{route('totalorderdata_search_print')}}" class="btn btn-primary btn-md" target="_blank" style="float: right">Print</a>
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


@section('pagescript')
    <script type="text/javascript">
        $('#searchproduct').on('keyup',function(){
            $value = $(this).val();
            var slag = $("#slag").val();
            $.ajax({
                type : 'get',
                url : '{{route('product.namedata')}}',
                data:{'search':$value},
                success:function(data){
                    $('tbody').html(data);
                }
            });
        })

        // $(document).on('click', '.productidedit', function() {
        //     var product_id = $(this).closest('tr').find('td:eq(1)').text();
        //     $.ajax({
        //         type : 'GET',
        //         url : '/Supershop/edit_data/'+product_id,
        //         success:function(data){
        //             location.href = "Supershop/edit_data/"+product_id;
        //         }
        //     });
        // })
        //
        // $(document).on('click', '.productidbuy', function() {
        //     var product_id = $(this).closest('tr').find('td:eq(1)').text();
        //     $.ajax({
        //         type : 'GET',
        //         url : '/supershop/purchase/'+product_id,
        //         success:function(data){
        //             location.href = "/supershop/purchase/"+product_id;
        //         }
        //     });
        // })


    </script>
@endsection


