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
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="breadcome-heading">
                                                        <form action="{{route('OrderDetailsdata_search')}}" method="GET">
                                                            {{ csrf_field() }}
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input class="form-control" placeholder="From date" type="date" name="startdate" name="fromdate" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input class="form-control" placeholder="To date" type="date" name="enddate" name="todate" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-primary btn-md">Filter</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="col-md-12">
                                                        <div class="breadcome-heading">
                                                            <form role="search" class="sr-input-func">
                                                                <input type="text" placeholder="Search Barcode" class="search-int form-control" id="searchproduct">
                                                                <a href="#"><i class="fa fa-search"></i></a>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
                                                <th>Product</th>
                                                <th>Code</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Amount</th>
                                                <th>Cost</th>
                                                <th>Discount</th>
                                                <th>Payable</th>
                                                <th>View</th>
                                                <th>Print</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $sl = 1; ?>

                                            @foreach ($orderdetails as $row)

                                                <tr>
                                                    <td>{{ $sl}}</td>
                                                    <td>{{ $row->selldate}}</td>
                                                    <td>{{ $row->invoice_no}}</td>
                                                    <td>{{ $row->product->product_name}}</td>
                                                    <td>{{ $row->product_code}}</td>
                                                    <td>{{ $row->quantity}}</td>
                                                    <td>{{ $row->sellprice}}</td>
                                                    <td>{{ $row->total_sellprice}}</td>
                                                    <td>{{ $row->sell_cost}}</td>
                                                    <td>{{ $row->sell_discount}}</td>
                                                    <td>{{ $row->lastsell_amount}}</td>
                                                    <td>
                                                        <a href="{{route('Order.show',$row->invoice_no)}}" target="_blank" class="btn btn-primary btn-sm" >view</a>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('Order_invoice.Print',$row->invoice_no)}}" target="_blank" > <img src="{{ URL::to('Media/icon/print_icon.png') }}" width="30px;"></a>
                                                    </td>
                                                </tr>
                                                <?php $sl++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-center">
                                                {{ $orderdetails->links() }}
                                            </ul>
                                        </nav>

                                    </div>

                                    <?php
                                    $recive = Cache::get("totalorderDetails_search");

                                    if($recive) {
                                    ?>
                                    <a href="{{route('totalorderDetails_search_print')}}" class="btn btn-primary btn-md" target="_blank" style="float: right">Print</a>
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
                url : '{{route('product.barcodesearch')}}',
                data:{'search':$value},
                success:function(data){
                    $('tbody').html(data);
                }
            });
        })

        $(document).on('click', '.ordrview', function() {
            var invoiceid = $(this).closest('tr').find('td:eq(2)').text();
            $.ajax({
                type : 'GET',
                url : '/Order/'+invoiceid,
                success:function(data){
                    window.open('/Order/'+invoiceid, '_blank');
                    //location.href = "/Order/Invoice/Search/"+invoiceid;
                }
            });
        })

        $(document).on('click', '.orderprint', function() {
            var invoiceid = $(this).closest('tr').find('td:eq(2)').text();
            $.ajax({
                type : 'GET',
                url : '/Order/Invoice/Print/'+invoiceid,
                success:function(data){
                    window.open('/Order/Invoice/Print/'+invoiceid, '_blank');
                }
            });
        })


    </script>
@endsection


