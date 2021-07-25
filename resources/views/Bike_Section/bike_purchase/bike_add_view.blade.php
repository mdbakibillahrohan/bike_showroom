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

                                    <form action="{{route('Bikeadd.store')}}" method="POST"  enctype="multipart/form-data" class="needs-validation" novalidate="novalidate">
                                        @csrf
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <label for="ProductName">Name Of Bike</label>
                                                <input autofocus="autofocus" class="form-control" type="text" name="bike_name" placeholder="Name Of Bike" required="required" value="{{ old('bike_name') }}"/>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Product Name !
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="bikeModel">Bike Model</label>
                                                <input class="form-control" type="text" name="bikemodel" id="bikeModel" placeholder="Bike Model" required="required" value="{{ old('bikemodel') }}"/>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Bike Model !
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="ProductDetails">Bike Details</label>
                                                <input class="form-control" type="text" name="product_deatils" id="ProductDetails" placeholder="Bike Details" required="required" value="{{ old('product_deatils') }}"/>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Bike Details !
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <label for="Productcategory">Product Category</label>
                                                <select name="categorie_id" id="categorydata_id" class="form-control" >
                                                    <option value=""> Select Category</option>
                                                    @foreach ($category as $catrow)
                                                        <option value="{{$catrow->id}}">{{$catrow->category_name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Product Category !
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="SubCategory">Sub Category</label>
                                                <select class="form-control" name="subcategorie_id" id="subcategoryid">
                                                    <option value="" id="" selected="selected"></option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Sub Category !
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="BrandID">Product Brand</label>
                                                <select class="form-control" name="brand" id="BrandID" >
                                                    <option value=""> Select Brand</option>
                                                    @foreach ($brand as $brow)
                                                        <option value="{{ $brow->id }}"> {{ $brow->brand_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Sub Category !
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="table-responsive">
                    <table class="table" id="ul-contact-list" style="width:100%">
                        <thead class="thead-dark">
                        <tr>
                            <th>SL</th>
                            <th>Bike ID</th>
                            <th>Name</th>
                            <th>Model</th>
                            <th>Details</th>
                            <th>Category</th>
                            <th>SubCategory</th>
                            <th>Brand</th>
                            <th>Update</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sl = 1; ?>
                        @foreach ($allbike as $row)
                            <tr>
                                <td>{{ $sl}}</td>
                                <td>{{ $row->id}}</td>
                                <td>{{ $row->name}}</td>
                                <td>{{ $row->model }}</td>
                                <td>{{ $row->details }}</td>
                                <td>{{ $row->categorie->category_name}}</td>
                                <td>{{ $row->subcategorie->subcategory_name}}</td>
                                <td>{{ $row->brand->brand_name}}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-success">Edit</a>
                                    <a href="{{route('bike.purchase')}}" class="btn btn-sm btn-warning">Buy</a>
                                </td>
                            </tr>
                            <?php $sl++; ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



@endsection


@section('pagescript')
    <script>
        $('#categorydata_id').on('change', function(){
            var catid = $(this).val();
            $.ajax({
                type: 'GET',
                url: '/categorydataid/'+catid,
                success: function (data) {
                   // console.log(data);
                    var select = '';
                    if (data[0] != null){
                        select += '<option value="">Sub Category</option>';
                        $.each(data, function (index, obj) {
                            select += ('<option value="'+ obj.id +'">' + obj.subcategory_name + '</option>');
                        });
                    }
                    $('#subcategoryid').html(select);

                }
            });
        });
    </script>
@endsection


