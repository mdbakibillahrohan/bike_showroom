@extends('Purchase_layouts.Purchase_master_layout')
@section('content')
    <style>
        .tag {
            background: none repeat scroll 0 0 #663399;
            border-radius: 2px;
            color: white;
            cursor: default;
            display: inline-block;
            position: relative;
            white-space: nowrap;
            padding: 4px 21px 4px 1px;
            margin: 3px 1px 0px 2px;
            float: left;
        }
        .tag span{
            display: none;
        }
        .tag .tag-i{
            margin-top: -4px;
            font-weight: bold;
            color: #00ff5a;
            font-size: 21px;
        }
        .tagging {
            border: 1px solid #dee2e6;
            font-size: 11px;
            height: auto;
            padding: 0px 4px 0px;
            border-radius: 2px;
            max-height: 88px;
            overflow-y: scroll;
            min-width: 190px;
        }
        .type-zone{
            width: 100%;
            height: 26px;
        }
    </style>
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

                                    <form action="{{route('Products.store')}}" method="POST"  enctype="multipart/form-data" class="needs-validation" novalidate="novalidate">
                                        @csrf

                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <label for="ProductName">Product name</label>
                                                <input autofocus="autofocus" class="form-control" type="text" name="product_name" id="ProductName" placeholder="Product name" required="required"/>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Product Name !
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="ProductDetails">Product Details</label>
                                                <input class="form-control" type="text" name="product_deatils" id="ProductDetails" placeholder="Product Details" required="required"/>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Product Details !
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="Productcategory">Product Category</label>
                                                <select name="categorie_id" id="categorydata_id" class="form-control" required="required">
                                                    <option value=""> Select Category</option>
                                                    @foreach ($allcategories as $catrow)
                                                        <option value="{{$catrow->id}}">{{$catrow->category_name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Product Category !
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
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
                                                    @foreach ($allbrand as $brow)
                                                        <option value="{{ $brow->id }}"> {{ $brow->brand_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Sub Category !
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="SellType">Sell Type</label>
                                                <select  name="selltype" class="form-control" required="" id="selltype_id">
                                                    <option value="">Select Unit</option>
                                                    <option value="Pic">Pic</option>
                                                    <option value="Color">Color</option>
                                                    <option value="Size">Size</option>
                                                    <option value="Gram">Gram</option>
                                                    <option value="ML">ML</option>
                                                    <option value="Dozen">Dozen</option>
                                                    <option value="Yard">Yard</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Sell Type !
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sell_type">
{{--                                            <div class="form-row">--}}
{{--                                                <div class="col-md-4 mb-3">--}}
{{--                                                    <fieldset>--}}
{{--                                                        <label class="form-control-label">Product Symbol: <span class="tx-danger"> *</span></label>--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <div class="tagBox case-sensitive" data-no-duplicate="true" data-pre-tags-separator="," data-no-duplicate-text="Duplicate tags" data-type-zone-class="type-zone" data-case-sensitive="true" data-tag-box-class="tagging"></div>--}}
{{--                                                        </div>--}}
{{--                                                    </fieldset>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
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
                            <th>Product ID</th>
                            <th>Product</th>
                            <th>Details</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Sell Type</th>
                            <th>Symbol</th>
                            <th>Update</th>
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
                                <td> {{$row->attrebute}}</td>
                                <td>
                                    <a href="{{ route('Products.edit',$row->id) }}" class="btn btn-sm btn-success">Edit</a>
                                    <a href="{{route('product.purchase_index')}}" class="btn btn-sm btn-warning">Buy</a>
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
    <script src="{{ asset('js/Product/product_add.js') }}"></script>
@endsection


