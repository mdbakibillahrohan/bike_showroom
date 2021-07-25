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

                                    <form action="{{route('Products.update',$productdata->id)}}" method="POST"  enctype="multipart/form-data" class="needs-validation" novalidate="novalidate">
                                        @method('put')
                                        @csrf

                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <label for="ProductName">Product name</label>
                                                <input class="form-control" type="text" name="product_name" id="ProductName" value="{{$productdata->product_name}}" placeholder="Product name" required="required"/>

                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="ProductDetails">Product Details</label>
                                                <input class="form-control" type="text" name="product_deatils" id="ProductDetails" value="{{$productdata->product_deatils}}" placeholder="Product Details" required="required"/>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="Productcategory">Product Category</label>
                                                    <select name="categorie_id" id="categorydata_id" class="form-control">
                                                        <option value=""> {{$productdata->categorie->category_name}}</option>
                                                        @foreach ($allcategories as $catrow)
                                                            <option value="{{$catrow->id}}">{{$catrow->category_name}}</option>
                                                        @endforeach
                                                    </select>

                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <label for="SubCategory">Sub Category</label>
                                                <select class="form-control" name="subcategorie_id" id="subcategoryid">
                                                    <option value="" id="" selected="selected"></option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="BrandID">Product Brand</label>
                                                <select class="form-control" name="brand" id="BrandID" >
                                                    <option value="">{{$productdata->brand->brand_name}}</option>
                                                    @foreach ($allbrand as $brow)
                                                        <option value="{{ $brow->id }}"> {{ $brow->brand_name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="SellType">Sell Type</label>
                                                <select  name="selltype" class="form-control" id="selltype_id">
                                                    <option value="">{{$productdata->sell_type}}</option>

                                                </select>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </form>
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
    <script src="{{ asset('js/Product/product_add.js') }}"></script>
@endsection


