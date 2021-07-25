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
            width: 190px;
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

                                    <form action="" method="POST"  enctype="multipart/form-data" class="needs-validation" novalidate="novalidate">
                                        @csrf

                                        <input type="hidden" name="" id="bigunit_relation">
                                        <input type="hidden" name="" id="smallunit_relation">
                                        <input type="hidden" name="" id="selltype">

                                        <input type="hidden" name="" id="productidval">
                                        <input type="hidden" name="" id="suplier_status">
                                        <input type="hidden" name="" id="suplier_ledger">
                                        <input type="hidden" name="" id="quantity_last">
                                        <input type="hidden" name="" id="suplierid">
                                        <input type="hidden" name="" id="product_namevalu">
                                        <input type="hidden" name="" id="checkvalchange">



                                        <div class="row rowpad">
                                            <div class="col-md-5">
                                                <div class="form-group row">
                                                    <div class="col-md-5" style="text-align: right;">
                                                        <label class="form-control-label">Supplier Name : <span class="tx-danger" > *</span></label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <select class="form-control" name="suplier_id" id="suplier_iddata" required>
                                                            <option value="">Select Supplier</option>
                                                            @foreach ($suplierdata as $data)
                                                                <option value="{{$data->id}}">{{$data->suplier_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please Select a valid Supplier !
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-1">
                                                <div class="test">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addsupplier">Add</button>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group row">
                                                    <div class="col-md-5" style="text-align: right;">
                                                        <label class="form-control-label">Sale Date : <span class="tx-danger"> *</span></label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <?php  use Illuminate\Support\Facades\Cache;$n_dat= date("Y-m-d"); ?>
                                                        <input type="date" class="form-control" name="sale_date" id="sellingdate" value="{{$n_dat}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                            </div>
                                        </div>

                                        <div class="row rowpad">
                                            <div class="col-md-3">
                                                <div class="ui-widget">
                                                    <label class="form-control-label">Product Name: <span class="tx-danger"> *</span></label>
                                                    <input autofocus="autofocus" class="form-control newtag" id="name_tags" placeholder="Product Name" required autocomplete="off">
                                                    <input type="hidden" class="form-control" id="tagsname" >
                                                    <div class="invalid-feedback">
                                                        Please provide a valid Product Name !
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="purchesh">

                                            </div>

                                            <div class="col-lg-2">
                                                <fieldset>
                                                    <label class="form-control-label">Product Code: <span class="tx-danger"> *</span></label>
                                                    <div class="form-group">
                                                        <div class="tagBox case-sensitive" data-no-duplicate="true" data-pre-tags-separator="," data-no-duplicate-text="Duplicate tags" data-type-zone-class="type-zone" data-case-sensitive="true" data-tag-box-class="tagging"></div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="ui-widget">
                                                    <label class="form-control-label">Total Quantity <span class="tx-danger"> *</span></label>
                                                    <input class="form-control" type="text" name="quantity"  placeholder="Purchase Quantity" required="" id="pic_value" autocomplete="off" >
                                                    <div class="invalid-feedback">
                                                        Please provide Purchase Quantity !
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row rowpad">
                                            <div class="col-md-8">
                                                <div class="form-row">
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-control-label">Buy Price Single <span class="tx-danger"> *</span></label>
                                                        <input class="form-control" type="text" name="buy_price"  placeholder="Buy Price" required="" id="buypriceval" autocomplete="off" >
                                                        <div class="invalid-feedback">
                                                            Please provide Buy Price !
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-control-label">Total Buy Amount</label>
                                                        <input class="form-control" type="text" name="total_buy_price"  placeholder="Total Buy Amount" id="totalbuyval" disabled="">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-control-label">Selling Price <span class="tx-danger"> *</span></label>
                                                        <input class="form-control" type="text" name="sell_price"  placeholder="Selling Price" required="" id="sellpriceval" autocomplete="off" >
                                                        <div class="invalid-feedback">
                                                            Please provide sell Price !
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1" style="margin-top: 32px;">
                                                        <button type="button" id="addbtn" class="glyphicon glyphicon-plus btn-primary btn-sm " aria-label="" > +
                                                        </button>
                                                    </div>

                                                </div>
                                                <div class="col-xs-12 table-responsive">
                                                    <table class="table table-striped table-bordered" id="item_list">
                                                        <thead class="thead-dark">
                                                        <tr>
                                                            <th>SL</th>
                                                            <th>Product</th>
                                                            <th>Buy Price </th>
                                                            <th>Quantity</th>
                                                            <th>Total Buy</th>
                                                            <th>Sell Price</th>
                                                            <th>Remove</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="accountsection">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                                        <label class="login2 pull-right pull-right-pro" style="font-size: 11px;">Total Buy :</label>
                                                                    </div>
                                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                                                        <input type="text" class="form-control" id="suplier_buy" disabled="" style="font-weight: bold" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                                        <label class="login2 pull-right pull-right-pro" style="font-size: 11px;">Labor/Other :</label>
                                                                    </div>
                                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                                                        <input type="text" class="form-control" name="labercost" id="laber_cost" style="font-weight: bold" autocomplete="off" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                                        <label class="login2 pull-right pull-right-pro" style="font-size: 11px;">Payable : </label>
                                                                    </div>
                                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                                                        <input type="text" class="form-control" id="paableamount" disabled="" style="font-weight: bold" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                                        <label class="login2 pull-right pull-right-pro" style="font-size: 11px;">Discount :</label>
                                                                    </div>
                                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                                                        <input type="text" class="form-control" name="discountflat" id="discount_flat" style="font-weight: bold" autocomplete="off" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                                        <label class="login2 pull-right pull-right-pro" style="font-size: 11px;">Sub Total :</label>
                                                                    </div>
                                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                                                        <input type="text" class="form-control" name="subtotal_cash" id="subtotal_cash" style="font-weight: bold" disabled/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                                        <label class="login2 pull-right pull-right-pro" style="font-size: 11px;"> Payment :</label>
                                                                    </div>
                                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                                                        <input type="text" class="form-control" name="cash_payment" id="suplier_payment" style="font-weight: bold" autocomplete="off" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                                        <label class="login2 pull-right pull-right-pro" style="font-size: 11px;">Previous Led :</label>
                                                                    </div>
                                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                                                        <input type="text" class="form-control" id="suplier_account" disabled="" style="font-weight: bold"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                                        <label class="login2 pull-right pull-right-pro" style="font-size: 11px;">Blanch :</label>
                                                                    </div>
                                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                                                        <input type="text" class="form-control" id="calculate" disabled="" style="font-weight: bold;color: red;" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                                        <label class="login2 pull-right pull-right-pro" style="font-size: 11px;">Include Cost :</label>
                                                                    </div>
                                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                                                        <input type="checkbox" class="form-check-input" id="checkval" name="buy_include" value="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="form-actions text-center">
                                        <button class="btn btn-primary pull-center" id="order_submit_btn">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <div class="table-responsive m-b-40">
                                        <table class="table table-striped table-data3 data-table1">
                                            <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Date</th>
                                                <th>Invoice No</th>
                                                <th>Supplier</th>
                                                <th>Buy</th>
                                                <th>Buy Cost</th>
                                                <th>Discount</th>
                                                <th>Total Buy</th>
                                                <th>View</th>
                                                <th>Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php $sl = 1; ?>
                                            @foreach ($productstokedata as $row)
                                                @php
                                                    $product_purchesh = \App\Product_model\Purchase::where('invoice_no',$row->invoice_no)->first();
                                                @endphp

                                                <tr>
                                                    <td>{{ $sl}}</td>
                                                    <td>{{$product_purchesh->purchase_date}}</td>
                                                    <td>{{$row->invoice_no}}</td>
                                                    <td>{{$product_purchesh->supplier->suplier_name}}</td>
                                                    <td>{{$row->sub_total_buy}}</td>
                                                    <td>{{$row->buy_cost}}</td>
                                                    <td>{{$row->discount}}</td>
                                                    <td>{{$row->actual_buy}}</td>
                                                    <td><a href="{{route('Purchase_invoice.Details',$row->invoice_no)}}" class="btn-primary btn-sm"> View</a></td>
                                                    <td><a class="btn btn-danger btn-sm" href="{{route('purchase.delete',$row->invoice_no)}}" id="delete" role="button">Delete</a></td>
                                                </tr>
                                                <?php $sl++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="text-center">
                                            {{ $productstokedata->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addsupplier" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Add Supplier</h4>
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
                    <form action="{{ route('supplier.store') }}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Showroom Name">Supplier Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="suplier_name" class="form-control" placeholder="Supplier Name" required="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Address">Address</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="address" class="form-control" id="address_add" placeholder="Address" >
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Contact">Contact</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="mobile" class="form-control" id="mobile_add" placeholder="Contact" required="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Contact">Previous Ledger</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="previus_ledger" class="form-control"  placeholder="Previous Ledger">
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
    {{--    <style>--}}
    {{--        .appendbody a .removexx, .removeFeatureGroupBtn removexx, .removeFeatureBtn removexx {--}}
    {{--            width: 25px;--}}
    {{--            float: right;--}}
    {{--            margin-top: 1px;--}}
    {{--            margin-right: -30px;--}}
    {{--        }--}}
    {{--        .appendbody{--}}
    {{--            padding: 22px;--}}
    {{--        }--}}
    {{--        .modal-footer {--}}
    {{--            display: flex;--}}
    {{--            align-items: center;--}}
    {{--            justify-content: flex-end;--}}
    {{--            border-top: 1px solid #eee;--}}
    {{--            height: 25px;--}}
    {{--            padding: 23px;--}}
    {{--            margin-bottom: 0px;--}}
    {{--        }--}}

    {{--    </style>--}}
    {{--    <div class="modal fade barcodemodalopen" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">--}}
    {{--        <div class="modal-dialog modal-md">--}}
    {{--            <div class="modal-content">--}}
    {{--                <div class="modal-header">--}}
    {{--                    <h5 class="modal-title" id="">Barcode Push</h5>--}}
    {{--                </div>--}}
    {{--                <form id="form">--}}
    {{--                    <div class="col-md-4 form-group mb-3 field_wrapper">--}}
    {{--                        <div class="appendbody">--}}
    {{--                            <input type="text"  class="form-control form-control-rounded appendform" id="seriallist" value="" placeholder="Barcode Fire"/>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="modal-footer">--}}
    {{--                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>--}}
    {{--                        <button type="button" data-dismiss="modal" class="btn btn-primary codesubmit">Save</button>--}}
    {{--                    </div>--}}
    {{--                </form>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    {{--    <link rel="stylesheet" href="{{ asset('Admin_asset/tagsinput/bootstrap-tagsinput.css') }}">--}}
    {{--    <script src="{{ asset('Admin_asset/tagsinput/111jquery.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('Admin_asset/tagsinput/bootstrap-tagsinput.min.js') }}"></script>--}}

@endsection


@section('pagescript')
    <script src="{{ asset('js/Product/purchase.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function(){

            {{-- $(document).on('change', "#seriallist", function(){--}}
            {{--     var seriallist = $("#seriallist").val();--}}
            {{-- });--}}


            {{-- var set_number = function(){--}}
            {{--     var table_len = $('#code_list tbody tr').length+1;--}}
            {{--     $('#product_Id').val(table_len);--}}
            {{-- }--}}
            {{--var productcode_info = [];--}}
            {{-- set_number();--}}
            {{-- var count = 1;--}}
            {{-- var sl = 1;--}}
            {{-- var sum = 0;--}}
            {{-- var wrapper;--}}

            {{-- $('#seriallist').keypress(function(event){--}}
            {{--     window.onload = init;--}}
            {{--     function init(){--}}
            {{--         document.getElementById("serial_list").focus();--}}
            {{--     }--}}

            {{--     if($(this).val().length >5 && length < 15){--}}
            {{--         var product_Id = $('#productidval').val();--}}
            {{--         var seriallist = $('#seriallist').val();--}}

            {{--         wrapper = $('.field_wrapper');--}}
            {{--         var fieldHTML = '<div class="appendbody"><input type="text" class="form-control form-control-rounded appendform" value="'+ seriallist +'" placeholder="Material Details"/><input type="hidden" class="index" id="'+count +'"><a href="javascript:void(0);" class="remove_button"><img src="{{asset('Media/image/remove-icon.png')}}" /></a></div>';--}}
            {{--         var maxField = 10;--}}
            {{--         var x = 1;--}}

            {{--             if(x < maxField){--}}
            {{--                 x++;--}}
            {{--                 $(wrapper).append(fieldHTML); //Add field html--}}
            {{--             }--}}

            {{--         count++ ;--}}
            {{--         sum += sl;--}}
            {{--         var indexval = count-1;--}}
            {{--         var newindex = indexval.toString();--}}
            {{--         $('#seriallist').val('');--}}
            {{--         obj = {product_Id:product_Id,seriallist:seriallist,serialindex:newindex};--}}
            {{--         productcode_info.push(obj);--}}
            {{--         return false;--}}
            {{--     }--}}
            {{--     //console.log(data);--}}
            {{-- });--}}

            {{-- $(document).on('click', '.remove_button', function(e) {--}}
            {{--     var serial_r = $(this).prev().attr("id");--}}
            {{--     const index = productcode_info.findIndex(function (todo, index){--}}
            {{--          return todo.serialindex === serial_r--}}
            {{--     })--}}
            {{--     productcode_info.splice(index, 1);--}}
            {{--    e.preventDefault();--}}
            {{--     $(this).parent('div').remove();--}}

            {{-- });--}}
            // $('[data-dismiss=modal]').on('click', function (e) {
            //     var $t = $(this),
            //         target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];
            //     $(target)
            //         .find("input,textarea,select")
            //         .val('')
            //         .end()
            //         .find("input[type=checkbox], input[type=radio]")
            //         .prop("checked", "")
            //         .end();
            //
            // })

        });
    </script>
@endsection


