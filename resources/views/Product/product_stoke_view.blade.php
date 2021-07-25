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
                                        <div class="col-md-3">
                                            <div class="breadcome-heading">
                                                <form role="search" class="sr-input-func">
                                                    <input type="text" placeholder="Search Product" class="search-int form-control" id="searchproduct">
                                                    <a href="#"><i class="search-icon text-muted i-Magnifi-Glass1"></i></a>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="ProductDetails"><b>Total Buy Amount</b> </label>
                                            <span>= <b>{{$producttotal->actual_buy}}</b></span>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="ProductDetails"><b>Total Sell Amount</b></label>
                                            <span> = <b>{{$selltotal->lastsell_amount}}</b></span>

                                        </div>
                                        <div class="col-md-3">
                                            <label for="ProductDetails"><b>Stoke Amount</b></label>
                                            <span> = <b>{{$producttotal->rest_buy_amount}}</b></span>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>SL</th>
                                                <th>ID</th>
                                                <th>Product</th>
                                                <th>Symbol</th>
                                                <th>Buy QTY</th>
                                                <th>Buy Price</th>
                                                <th>Buy Amount</th>
                                                <th>Last QTY</th>
                                                <th>Stoke Amount</th>
                                                <th>Sell Price</th>
                                                <th>View</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $sl = 1; ?>

                                            @foreach ($productstokedata as $row)
                                                      @php
                                                          $productsdata = \App\Product_model\Purchase::where('product_id',$row->product_id)->first();
                                                      @endphp
                                                <tr>
                                                    <td>{{ $sl}}</td>
                                                    <td>{{ $row->product_id}}</td>
                                                    <td>{{$row->product->product_name}}</td>
                                                    <td>{{$row->attribute}}</td>
                                                    <td>{{$row->totalqty}}</td>
                                                    <td>{{$productsdata->buy_price}}</td>
                                                    <td>{{$row->sub_total_buy}}</td>
                                                    <td>{{$row->rest_qty}}</td>
                                                    <td>{{$row->rest_buy_amount}}</td>
                                                    <td>{{$productsdata->sell_price}}</td>
                                                    <td>
                                                        <a href="{{route('single_Purchase.view',$row->product_id)}}" class="btn btn-sm btn-success">View</a>
                                                    </td>
                                                </tr>
                                                <?php $sl++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center">
                                        {{ $productstokedata->links() }}
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
    <script type="text/javascript">
        $('#searchproduct').on('keyup',function(){
            $value = $(this).val();
            var slag = $("#slag").val();
            $.ajax({
                type : 'get',
                url : '{{route('product.purcheshdata')}}',
                data:{'search':$value},
                success:function(data){
                    $('tbody').html(data);
                }
            });
        })


        $(document).on('click', '.product_view', function() {
            var product_id = $(this).closest('tr').find('td:eq(1)').text();
            $.ajax({
                type : 'GET',
                url : '/Product/Purchase/Details/'+product_id,
                success:function(data){
                    location.href = '/Product/Purchase/Details/'+product_id;
                }
            });
        })


    </script>
@endsection


