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
                                        <div class="col-md-4">
                                            <div class="breadcome-heading">
                                                <form role="search" class="sr-input-func">
                                                    <input type="text" placeholder="Search Product" class="search-int form-control" id="searchproduct">
                                                    <a href="#"><i class="search-icon text-muted i-Magnifi-Glass1"></i></a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>SL</th>
                                                <th>ID</th>
                                                <th>Product</th>
                                                <th>Details</th>
                                                <th>Category</th>
                                                <th>Brand</th>
                                                <th>Sell Type</th>
                                                <th>Edit</th>
                                                <th>Buy</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $sl = 1; ?>
                                            @foreach ($productdata as $row)
                                                <tr>
                                                    <td>{{ $sl}}</td>
                                                    <td>{{ $row->id}}</td>
                                                    <td>{{ $row->product_name}}</td>
                                                    <td>{{ $row->product_deatils }}</td>
                                                    <td>{{ $row->categorie->category_name}}</td>
                                                    <td>{{ $row->brand->brand_name}}</td>
                                                    <td>{{ $row->sell_type}}</td>
                                                    <td>
                                                        <a href="{{ route('Products.edit',$row->id) }}" class="btn btn-sm btn-success">Edit</a>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('product.purchase_index')}}" class="btn btn-sm btn-warning">Buy</a>
                                                    </td>
                                                </tr>
                                                <?php $sl++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center">
                                        {{ $productdata->links() }}
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
                url : '{{route('product.namedata')}}',
                data:{'search':$value},
                success:function(data){
                    $('tbody').html(data);
                }
            });
        })

        $(document).on('click', '.productidedit', function() {
            var product_id = $(this).closest('tr').find('td:eq(1)').text();
            $.ajax({
                type : 'GET',
                url : '/Products/'+product_id+'/edit',
                success:function(data){
                    location.href = '/Products/'+product_id+'/edit';
                }
            });
        })

        $(document).on('click', '.productidbuy', function() {
            var product_id = $(this).closest('tr').find('td:eq(1)').text();
            $.ajax({
                type : 'GET',
                url : '/Product/Purchase',
                success:function(data){
                    location.href = "/Product/Purchase";
                }
            });
        })



    </script>
@endsection


